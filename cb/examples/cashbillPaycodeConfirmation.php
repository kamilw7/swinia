<?php
require 'cashbillInit.php';

if ($cashbill->checkNotifyRequest ()) {
	$code = $_GET ['code'];
	/*
	 * @TODO: W tym miejscu należa aktywować kod $code
	 */
	$cashbill->notifySuccess ();
} else {
	$cashbill->notifyError ( 'Brak autoryzacji potwierdzenia' );
}