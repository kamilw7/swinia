<?php

require_once("classes/db/db.php");
require_once("includes/show.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(8,0);

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td><font size="2">';
echo $thumb['name'];
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}

echo '</div>';
?>
