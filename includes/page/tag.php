<div id="headerbox">TAGI:</div>

<?php

require_once("classes/db/db.php");
require_once("includes/show.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(20,"`rate`");



foreach ($thb as $thumb){
echo '<div id="tag">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table cellspacing="2" align="center">';
echo '<tr><td><font size="2">';
echo $thumb['name'];
echo '</font></td></tr>';
echo '</table>';
echo '</a>';
echo '</div>';
}



?>
