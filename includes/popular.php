
<div id="popular">
<div id="headerbox">
POPULARNE:
</div>
<?php

require_once("classes/db/db.php");
require_once("includes/show.php");
require_once("classes/cutter/cut.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(9,"`rate`");

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}

echo '</div>';
?>
</div>
