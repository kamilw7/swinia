
<?php

function showcommentrateicons($fileid, $cid){

require_once('classes/db/db.php');
$baza = new DBconn;
$baza->connect();

$rate = $baza->getcommentrate($cid);

$doret = '<font size="2"><div id="rate"><div id="ratecount">';
$doret.=  '<a href="?page=show&fileid='.$fileid.'&commentid='.$cid.'&commentrate=git">+ </a></div>';
$doret.= '<div id="ratecount">';
$doret.= $rate;
$doret.= '</div><div id="ratecount">';
$doret.= '<a href="?page=show&fileid='.$fileid.'&commentid='.$cid.'&commentrate=shit"> -</a>';
$doret.= '</div></div></font>';

return $doret;

}

?>
