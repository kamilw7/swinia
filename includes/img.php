<?php

require_once('includes/menu.php');
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

require_once('classes/rate/imgrate.php');
$imgrate = showrateicons($latest);
echo $imgrate;

echo '
<table align="center">
<tr>
<td>
Imie:
</td>
<td> '
. $description["name"] .
'</td>
</tr>
<tr>
<td>
</td>
<td>'
. 
'</td>
</tr>
<tr>
<td>
Opis
</td>
<td>'
. $description["description"] .
'</td>
</tr>
<tr>
<td>
Data dodania:
</td>
<td>'
. @date("Y-m-d H:i:s", $description["added"]) .
'</td>
</tr>
<tr>
<td>
Dodane przez:
</td>
<td>'
. $description["user"] .
'</td>
</tr>
<tr>
<td colspan="2">
<font color="red"><a href="?page=remove&fid='.$description["fileid"].'">Usuń zdjęcie</a></font>
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
require_once("includes/popular.php");

?>
