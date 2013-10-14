<?php
require_once('includes/menu.php');
require_once('includes/show.php');

require_once('classes/db/db.php');
$baza = new DBconn;
$baza->connect();
$latest = $baza->getlatest();

echo "<br />";
$img = showcat($latest);
echo $img;

$description = showcatdesc($latest);

require_once('classes/imgrate/imgrate.php');

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
require_once('classes/comments/showcomments.php');


?>
