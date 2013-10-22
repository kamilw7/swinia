<?php

require ('classes/cb/cashbillInit.php');

require_once('includes/header.php');
require_once('includes/menu.php');
require_once('includes/show.php');

echo '<div id="add">';
if (isset ($_GET["fid"])){
$fileid = $_GET["fid"];

$baseUrl = 'http://swinia.cc/';	// w produkcyjnym środowisku proszę ustawić stały adres URL

setcookie ("FileIDCookie", $fileid ,time()+1800);
$url = $cashbill->getCodeUrl( $baseUrl.'return.php?fid='.$fileid,       // $redirectUrl - adres, na który wróci klient po dokonaniu zakupu 
		  					  $baseUrl.'confirmation.php', // $notifyUrl   - adres, na który zostanie wysłane podpisane potwierdzenie transakcji 
							  
$fileid,
9.99										  // $amount      - kwota transakcji (domyślnie w PLN)
							);




echo "<b>Czy na pewno chcesz usunąć ten wpis?</b> <br />
<br />";
echo '<br />';
echo '<a href="'.$url.'"><img src="content/images/payment.png" width="100" /><br />';
echo ' Przejdź do płatności przelewem bankowym (Wszystkie banki w Polsce) </a><br /><br />';
echo '<a href="sms.php?fid='.$fileid.'"><img src="content/images/sms.png" width="100" /><br />';
echo '<font size="3"> Przejdź do płatności SMS </font> </a><br /><br />';
$img = showcatlower($fileid);
echo $img;

}
else 
{ echo 'Nie wybrano zdjecia do usuniecia';
}


echo '</div>';

require_once('includes/footer.php');
?>
