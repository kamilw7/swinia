<?php
/**
 * 2010-02-19 cashbillCode.php
 *
 * @author Mariusz Chwalba <koder at cashbill dot pl>
 * @copyright 2010 Media Systems
 * @package ppp2
 *
 * Pakiet obsługi sprzedaży kodów internetowych.
 */

/**
 * @page intercodes Kody Internetowe
 *
 * Sprzedaż kodów internetowych jest formą pobierania opłat za korzystanie
 * z usług serwisu internetowego umożliwiającą uczestnictwo w Programie
 * Partnerskim Cashbill.
 *
 * Zakup kodu następuje poprzez kanały płatności internetowych.
 *
 * Serwis partnera ma możliwość wygenerowania dowolnego kodu dla klienta.
 * Nowo wygenerowany kod jest nieaktywny. Po dokonaniu płatności
 * system Cashbill informuje partnera o konieczności aktywacji danego kodu.
 *
 * Śledzenie aktywności kodu wykonywane jest przez serwis partnera, umożliwiając
 * świadczenie szerokiej gamy usług.
 */

/**
 * Klasa obsługi sprzedaży kodów internetowych.
 * Dostarcza narzędzia do
 * przygotowania nowej transakcji sprzedaży kodów, weryfikacji powiadomienia
 * poprawnej sprzedaży oraz obsługę programu partnerskiego.
 */
class cCashbillCode {
	const CASHBILL_URL = 'https://ppp.cashbill.pl/';
	protected $sysId, $secret, $encoding;
	
	/**
	 * Inicjalizacja usługi.
	 * Konieczne parametry identyfikacyjne dla
	 * punktu płatności można odczytać z panelu cashbill.pl.
	 *
	 * @param string $sysId
	 *        	- identyfikator serwisu, z panelu cashbill.pl
	 * @param string $secret
	 *        	- klucz tajny serwisu, z panelu cashbill.pl
	 * @param string $encoding
	 *        	- wykorzystywane kodowanie znaków w opisie transakcji. Domyślne UTF-8
	 */
	public function __construct($sysId, $secret, $encoding = 'UTF-8') {
		$this->sysId = $sysId;
		$this->secret = $secret;
		$this->encoding = $encoding;
	}
	
	/**
	 * Pomocnicza funkcja generująca losowy kod alfanumeryczny
	 *
	 * @param number $length        	
	 */
	public static function generateCode($length = 8) {
		$namespace = strtoupper ( 'abcedfghijkmnpqrstuvwxyz' ); // ograniczona przestrzeń znaków by zapobiec pomyłkom
		$code = '';
		for($j = 0; $j < $length; $j ++) {
			$code .= $namespace [rand ( 1, strlen ( $namespace ) ) - 1];
		}
		return $code;
	}
	
	/**
	 * Pobranie URL rozpoczęcia transakcji sprzedaży kodu.
	 *
	 * Do redirectUrl i notifyUrl zostanie automatycznie doklejona zmienna code zawierająca wygenerowany kod
	 *
	 * @param string $redirectUrl        	
	 * @param string $notifyUrl        	
	 * @param float $amount        	
	 * @param string $currency        	
	 * @param string $ref        	
	 * @return string
	 */
	public function getCodeUrl($redirectUrl, $notifyUrl, $imgid, $amount, $currency = 'PLN', $ref = '') {
		$code = self::generateCode ();
		$title = 'Kod ' . $code . ' do serwisu ' . $this->sysId;
		
		$notifyUrl = self::fillUrl ( $notifyUrl ) . 'code=' . $code . '&imgid=' . $imgid;
		$redirectUrl = self::fillUrl ( $redirectUrl ) . 'code=' . $code;
		
		return $this->getTransactionUrl ( $ref, $amount, $currency, $title, $notifyUrl, $redirectUrl );
	}
	
	/**
	 * Uzupełnia adres URL tak, by doklejki (sygnatury, parametry) nie niszczyły formatu
	 *
	 * @param string $url        	
	 * @return string
	 */
	protected static function fillUrl($url) {
		if (strpos ( $url, '?' ) === false) {
			$url .= '?';
		} else {
			if (substr ( $url, - 1 ) != '&')
				$url .= '&';
		}
		return $url;
	}
	
	/**
	 * Pobranie URL rozpoczęcia transakcji.
	 * Wysłanie klienta pod wskazany
	 * adres URL zainicjuje transakcję.
	 *
	 * @param string $ref
	 *        	- kod referencyjny programu partnerskiego. Dla serwisów nie uczestniczących w programie partnerskim należy pozostawić pusty.
	 * @param float $amount
	 *        	- cena kodu
	 * @param string $currency
	 *        	- waluta. Dla złotówki: PLN.
	 * @param string $title
	 *        	- tytuł transakcji. Powinien zawierać sprzedawany kod, np. "Kod ASDFQW dla serwisu www.przykład.pl"
	 * @param string $notifyUrl
	 *        	- adres URL na który system Cashbill prześle powiadomienie o dokonaniu transakcji. Powinien zawierać parametry wystarczające do identyfikacji konkretnego kodu ( Przykładowy skrypt odbiorczy w pliku cashbillExampleConfirmation.php ).
	 * @param string $redirectUrl
	 *        	- adres URL na który zostanie przekierowany klient po zakupie kodu. Może zawierać w parametrach kod, co w połączeniu z odpowiednią konstrukcją strony, umożliwi zwolnienie klienta z konieczności ręcznego przepisania kodu do formularza.
	 */
	public function getTransactionUrl($ref, $amount, $currency, $title, $notifyUrl, $redirectUrl) {
		// uzuełnienie notifyUrl, by sygnatura nie uszkodziła adresu
		$notifyUrl = self::fillUrl ( $notifyUrl );
		
		$sign = md5 ( $this->sysId . $ref . $amount . $currency . $title . $notifyUrl . 'bounce-signed' . $redirectUrl . $this->secret );
		
		$data = array (
				
				'sysid' => $this->sysId,
				'ref' => $ref,
				'encoding' => $this->encoding,
				'amount' => $amount,
				'currency' => $currency,
				'notifyUrl' => $notifyUrl,
				'notifyMode' => 'bounce-signed',
				'redirectUrl' => $redirectUrl,
				'title' => $title,
				'sign' => $sign 
		);
		
		$url = self::CASHBILL_URL . 'pay/get/?';
		foreach ( $data as $key => $value ) {
			$url .= urlencode ( $key ) . '=' . urlencode ( $value ) . '&';
		}
		
		return $url;
	}
	protected function checkSignature($queryString) {
		$sign = substr ( $queryString, - 32 );
		$base = substr ( $queryString, 0, - 32 );
		
		return md5 ( $base . $this->secret ) == $sign;
	}
	
	/**
	 * Sprawdza, czy aktualne żądanie zawiera poprawną sygnaturę
	 * systemu Cashbill.
	 *
	 * @return boolean
	 */
	public function checkNotifyRequest() {
		return $this->checkSignature ( $_SERVER ['QUERY_STRING'] );
	}
	
	/**
	 * Informuje system Cashbill o przyjęciu potwierdzenia płatności.
	 */
	public function notifySuccess() {
		echo 'OK';
	}
	
	/**
	 * Informuje system Cashbill o błędzie przy przyjmowaniu potwierdzenia płatności.
	 * 
	 * @param string $error        	
	 */
	public function notifyError($error) {
		echo 'ERROR: ' . $error;
	}
}

