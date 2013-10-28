<?php

require_once('includes/menu.php');
require_once("includes/popular.php");
require_once('includes/show.php');
require_once('includes/prevnext.php');

require_once('classes/db/db.php');

$baza = new DBconn;
$baza->connect();

if (isset($_GET['fileid']))
{
$latest = $_GET['fileid'];

if (isset($_GET['rate'])){
$baza->setimgrate($latest, $_GET['rate']);
}

if (isset($_GET['commentrate'])){
$baza->setcommentrate($_GET['commentid'], $_GET['commentrate']);
}

} 
else {
$latest = $baza->getlatest();
}

showprevnext($_GET['fileid']);

echo '<div id="img">';
$img = showcat($latest);
echo $img;
echo '</div>';
echo '
<div class="fb-like" id="fblike" data-href="http://www.swinia.cc/?page=show&fileid='.$latest.'" data-width="600" data-height="The pixel height of the plugin" data-colorscheme="dark" data-layout="standard" data-action="like" data-show-faces="true" data-send="true"></div>
';
showprevnextarrows($_GET['fileid']);
/*
echo '<div id="img">';
$img = showcatthumb($latest);
echo $img;
echo '</div>';
*/



$description = showcatdesc($latest);
$meta = showcatmeta($latest);

require_once('classes/rate/imgrate.php');
$imgrate = showrateicons($latest);
echo $imgrate;



$fault = wordwrap($description["fault"], 60, "<br />\n", true);
$description1 = wordwrap($description["description"], 60, "<br />\n", true);
 

echo '
<table align="center">
<tr>
<td align="left">
Imie:
</td>
<td><b>'
. $description["name"] .
'</b></td>
</tr>
<tr>
<td>
</td>
<td>'
. 
'</td>
</tr>
<tr>
<td align="left">
Czym podpadła:
</td>
<td><b>'
. $fault .
'</b></td>
</tr>
<tr>
<td align="left">
Opis świństwa:
</td>
<td><b>'
. $description1 .
'</b></td>
</tr>
<tr>
<tr>
<td align="left">
Miasto:
</td>
<td><b>'
. $meta["locale"] .
'</b></td>
</tr>
<tr>
<td align="left">
Ulica:
</td>
<td><b>'
. $meta["street"] .
'</b></td>
</tr>
<tr>
<td align="left">
Wiek:
</td>
<td><b>'
. $meta["age"] .
'</b></td>
</tr>
<tr>
<tr>
<td align="left">
Data dodania:
</td>
<td><b>'
. @date("Y-m-d H:i:s", $description["added"]) .
'</b></td>
</tr>
<tr>
<td align="left">
Dodane przez:
</td>
<td><b>'
. $description["user"] .
'</b></td>
</tr>
<tr>
<td colspan="2">
<font size ="1" color="red"><a href="./remove.php?fid='.$description["fileid"].'">Usuń zdjęcie</a></font>
</td>
</tr>
</table>
';

require_once('classes/comments/addcomment.php');
showform($latest);
if (isset($_GET['action'])){
if ($_GET['action'] == "add"){

$baza->addcomment($latest, $_POST['kitten_comment']);
echo "Komentarz dodany";
}
}

echo '<table width="1000" align="right"><tr><td width="1000"><font size="2"><a href="?page=show&fileid='.$_GET['fileid'].'&order=DESC">Najlepsze</a><a href="?page=show&fileid='.$_GET['fileid'].'&order=ASC"> Najgorsze</a></font></td></tr></table>';

if (isset ($_GET['order'])){ 
$order = $_GET['order'];
}
else $order = "DESC";

require_once('classes/comments/showcomment.php');
showcomment($latest, $order);
require_once("includes/latest.php");
require_once("includes/random.php");

?>
