<?php

require ('classes/cb/includes/cashbillInit.php');

$baseUrl = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['REQUEST_URI']).'/';	// w produkcyjnym środowisku proszę ustawić stały adres URL

$url = $cashbill->getCodeUrl( $baseUrl.'page=remove&action=return',       // $redirectUrl - adres, na który wróci klient po dokonaniu zakupu 
		  					  $baseUrl.'?page=remove&action=confirmation', // $notifyUrl   - adres, na który zostanie wysłane podpisane potwierdzenie transakcji 
							  9.99										  // $amount      - kwota transakcji (domyślnie w PLN)
							);

echo '<a href="'.$url.'">Usun zdjecie!</a>';
