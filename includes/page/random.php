<div id="headerbox">
ŚWINKI:
</div>

<?php

require_once("classes/db/db.php");
require_once("classes/cutter/cut.php");
require_once("includes/show.php");

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(3,"RAND()");

?>
<?php
foreach ($thb as $thumb){
echo '<div id="pagethumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="left"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="20" width="100" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
echo '<div id="pagedesc">';
echo '<table><tr><td align="left" width="130">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
$textfault = cS($thumb['fault'], 100);
$textfault = wordwrap($textfault, 20, "<br />\n", true);
echo $textfault; 

echo '</a>';
echo '</td></tr></table>';
echo '</div>';
}
?>
</div>
<div id="pagemainimg">
<div id="mainheaderboxinside">
<div id="headerbox">
ŚWINKA DNIA:
</div>
</div>


<?php
/* SWINIA NA STALE */
$sswinia = $baza->getrecord("f5bfe88280d417d9497f8413cd2a1f34");

$img = showcatmain($sswinia['fileid']);
echo '<a href="?page=show&fileid='.$sswinia['fileid'].'">';
echo $img;
echo '</a>';
?>
<div id="mainimginside">
<div id="mainimgtext">
<b><?php echo $sswinia['name']; ?></b><br /><br />
<?php 

$textfault = cS($sswinia['fault'], 150);
$textfault = wordwrap($textfault, 60, "<br />\n", true);
echo $textfault; 
/* END OF SWINIA NA STALE */

/*
$img = showcatmain($thumb['fileid']);
echo '<a href="?page=show&fileid='.$thumb['fileid'].'">';
echo $img;
echo '</a>';
?>
<div id="mainimginside">
<div id="mainimgtext">
<b><?php echo $thumb['name']; ?></b><br /><br />
<?php 

$textfault = cS($thumb['fault'], 170);
$textfault = wordwrap($textfault, 60, "<br />\n", true);
echo $textfault; 
*/


?>
</div>
</div>


