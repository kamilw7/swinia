
<?php

function showrateicons($fileid){

require_once('classes/db/db.php');
$baza = new DBconn;
$baza->connect();

$rate = $baza->getimgrate($fileid);

$doret = '<div id="rate"><div id="ratecount">';
$doret.=  '<a href="?page=show&fileid='.$fileid.'&rate=git"><img src="content/images/git.png" width="70" /></a></div>';
$doret.= '<div id="ratecount">';
$doret.= $rate;
$doret.= '</div><div id="ratecount">';
$doret.= '<a href="?page=show&fileid='.$fileid.'&rate=shit"><img src="content/images/shit.png" width="70" /></a>';
$doret.= '</div></div>';

return $doret;

}

?>

