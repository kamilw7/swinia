<?php
require ('classes/cb/cashbillInit.php');
require_once('classes/db/db.php');

if ($cashbill->checkNotifyRequest ()) {


	$code = $_GET ['code'];
	$fileid = $_GET ['imgid'];	

	$baza = new DBconn;
	$baza->connect();
	$baza->setimgcode($fileid, $code); 
	//setcookie ("FileIDCookie", "", time() - 3600);

	$cashbill->notifySuccess ();
} else {
	$cashbill->notifyError ( 'Brak autoryzacji potwierdzenia' );
}
