<?php
require_once("classes/db/db.php");

function showprevnext($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getprevnext($filename);

echo '<div id="prevnext">';
echo '<table width="600"><tr><td align="left">';
echo '<a href="?page=show&fileid='.$baza->getfilebyid($imgid["prev"]).'">Poprzedni</a>';
echo '</td><td>&nbsp</td><td align="right">';
echo '<a href="?page=show&fileid='.$baza->getfilebyid($imgid["next"]).'">Następny</a>';
echo '</td></tr></table>';
echo "</div>";
}

function showprevnextarrows($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getprevnext($filename);

echo '<div id="prevnext">';
echo '<table width="600"><tr><td align="left">';
echo '<a href="?page=show&fileid='.$baza->getfilebyid($imgid["prev"]).'"><img src="content/images/prev.png" width="45" /></a>';
echo '</td><td>&nbsp</td><td align="right">';
echo '<a href="?page=show&fileid='.$baza->getfilebyid($imgid["next"]).'"><img src="content/images/next.png" width="45" /></a>';
echo '</td></tr></table>';
echo "</div>";
}

?>
