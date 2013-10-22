<?php
require_once('includes/menu.php');
//require_once('content/contentheader.php');
?>
<div id="cpage">


<?php

require_once('classes/db/db.php');
require_once("classes/cutter/cut.php");
require_once('includes/show.php');

if (isset($_GET["filter"])){
switch ($_GET["filter"])
{

//--------------------------------------------------------------------//
case "latest":
$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(50,"`added`");

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="25" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}
echo '</div>';
break;
//--------------------------------------------------------------------//
case "topten":
$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(10,"`rate`");

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="25" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}
echo '</div>';
break;
//--------------------------------------------------------------------//
default:
$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(100,"RAND()");

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="25" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}
echo '</div>';
break;
//--------------------------------------------------------------------//
}
} else {

$baza = new DBconn;
$baza->connect();
$thb = $baza->getimgs(100,"RAND()");

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="25" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}
echo '</div>';

}

?>


</div>
<?php
//require_once('content/contentfooter.php');
?>
