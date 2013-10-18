<?php
require ('classes/cb/includes/cashbillInit.php');

if ($cashbill->checkNotifyRequest ()) {
	$code = $_GET ['code'];
	/*
	 * @TODO: W tym miejscu należa aktywować kod $code
	 */

	echo "TEST: USUNALEM ZDJECIE!";

	$cashbill->notifySuccess ();
} else {
	$cashbill->notifyError ( 'Brak autoryzacji potwierdzenia' );
}
