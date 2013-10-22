<?php

require_once('includes/menu.php');
require_once("includes/popular.php");
require_once('includes/show.php');

require_once('classes/db/db.php');
$baza = new DBconn;
$baza->connect();

if (isset($_GET['fileid']))
{
$latest = $_GET['fileid'];

if (isset($_GET['rate'])){
$baza->setimgrate($latest, $_GET['rate']);
}

} 
else {
$latest = $baza->getlatest();
}

echo '<div id="img">';
$img = showcat($latest);
echo $img;
echo '</div>';

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


require_once('classes/comments/showcomment.php');
showcomment($latest);
require_once("includes/latest.php");
require_once("includes/random.php");

?>
