<?php

require ('classes/cb/cashbillInit.php');

require_once('classes/db/db.php');
require_once('includes/header.php');
require_once('includes/menu.php');
require_once('includes/show.php');

echo '<div id="add">';
if (isset ($_GET["fid"])){

$fileid = $_GET["fid"];
$code = $_GET["code"];

$baza = new DBconn;
$baza->connect();
$kod = $baza->getimgcode($fileid);

if ($kod == $code){
echo "<b>Płatność zweryfikowana pozytywnie.</b> <br />
<br />";
echo '<b><a href="./?page=remove&fid='.$fileid.'&code='.$code.'">Kliknij TUTAJ aby usunąć wpis.</a></b>';
echo '<br /><br /><br />';
$img = showcat($fileid);
echo $img;
}
else{
echo 'Płatność niezweryfikowana.';
}

}//fi fid
else 
{ echo 'Nie wybrano zdjecia do usuniecia';
}


echo '</div>';

require_once('includes/footer.php');
?>
