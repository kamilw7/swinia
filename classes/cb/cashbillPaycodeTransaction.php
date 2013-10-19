<?php

require ('classes/cb/cashbillInit.php');

$baseUrl = 'http://swinia.cc/';	// w produkcyjnym środowisku proszę ustawić stały adres URL

$url = $cashbill->getCodeUrl( $baseUrl.'?page=remove&action=return&',       // $redirectUrl - adres, na który wróci klient po dokonaniu zakupu 
		  					  $baseUrl.'?page=remove&action=confirmation&', // $notifyUrl   - adres, na który zostanie wysłane podpisane potwierdzenie transakcji 
							  9.99										  // $amount      - kwota transakcji (domyślnie w PLN)
							);

echo '<a href="'.$url.'">Usun zdjecie!</a>';

