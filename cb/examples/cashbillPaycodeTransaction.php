<?php

require 'cashbillInit.php';

$baseUrl = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/';	// w produkcyjnym środowisku proszę ustawić stały adres URL

$url = $cashbill->getCodeUrl( $baseUrl.'cashbillPaycodeReturn.php',       // $redirectUrl - adres, na który wróci klient po dokonaniu zakupu 
		  					  $baseUrl.'cashbillPaycodeConfirmation.php', // $notifyUrl   - adres, na który zostanie wysłane podpisane potwierdzenie transakcji 
							  9.99										  // $amount      - kwota transakcji (domyślnie w PLN)
							);

echo '<a href="'.$url.'">Sprzedaz kodu</a>';