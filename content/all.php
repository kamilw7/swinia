<div id="cpage">
<?php
require_once('classes/db/db.php');
$baza = new DBconn;
$baza->connect();
require_once('includes/menu.php');
//require_once('content/contentheader.php');
require_once("classes/cutter/cut.php");
require_once('includes/show.php');



if (isset($_GET["filter"])){
switch ($_GET["filter"])
{
//--------------------------------------------------------------------//
case "latest":
$thb = $baza->getimgs(50,"`added`");
break;
//--------------------------------------------------------------------//
case "topten":
$thb = $baza->getimgs(10,"`rate`");
break;
//--------------------------------------------------------------------//
default:
$thb = $baza->getimgs(100,"RAND()");
break;
//--------------------------------------------------------------------//
}
} else {
$thb = $baza->getimgs(100,"id");
}//fi

echo '<div id="thumbnails">';

foreach ($thb as $thumb){

$meta = $baza->getimgmeta($thumb["fileid"]);

echo '<table align="center" width="400"><tr><td width="125">';

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

echo '</td><td align="left" valign="top">';
echo '<b>'.$thumb['name'].'</b>';
echo ', ';
if ($meta['age'] != "0"){
echo $meta['age'];
}
echo ', ';
if ($meta['locale'] != "all"){
echo $meta['locale'];
}
echo '<br /><br />'.$thumb["fault"];


echo '</td></tr></table><br />';

}
echo '</div>';
?>


</div>
<?php
//require_once('content/contentfooter.php');
?>
