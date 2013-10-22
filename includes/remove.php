<?php require_once('includes/menu.php'); ?>
<div id="add">
<?php

require_once('classes/db/db.php');


if (isset ($_GET["fid"])){

$fileid = $_GET["fid"];
$code = $_GET["code"];

	$baza = new DBconn;
	$baza->connect();
	$kod = $baza->getimgcode($fileid);
	
if ($kod == $code){

$baza->setimgvisibility($fileid, 0);
echo "Wpis pomyślnie usunięty!";
}
}
else {
echo "Nie wybrano zdjecia do usuniecia";
}
?>
</div>
