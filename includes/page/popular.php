<div id="headerbox">POPULARNE:</div>

<?php

require_once("classes/db/db.php");
require_once("includes/show.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(20,"`rate`");



foreach ($thb as $thumb){
echo '<div id="pagethumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table cellspacing="2" align="center">';

echo '<tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr>';

echo '<tr><td><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr>';
echo '</table>';
echo '</a>';
echo '</div>';
}



?>

