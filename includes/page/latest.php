

<div id="headerbox">NAJNOWSZE:</div>

<?php

require_once("classes/db/db.php");
require_once("includes/show.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(4,"`added`");



foreach ($thb as $thumb){
echo '<div id="pagethumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="30" width="100" valign="middle"><font size="2">';
echo $thumb['name'];
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';

echo '<div id="pagedesc">';
echo '<table><tr><td width="100">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo $thumb['fault'];
echo '</a>';
echo '</td></tr></table>';
echo '</div>';
}


?>

