<div id="content">
<?php

require_once('includes/show.php');

if (isset ($_GET["fid"])){

$fileid = $_GET["fid"];

echo "<b>Czy na pewno chcesz usunąć tego kotka?</b> <br />
<br />";
$img = showcat("e1a1c0beda18891598ec4d0bb8d3361f");
echo $img;

echo "<br /><br />*<br /><br />";
echo "Zapłać sms:";

echo "<br /><br />*<br /><br />";

echo'

<form enctype="multipart/form-data" action="?page=remove" 
		 method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="5120000000" />
<table align="center">
<tr>
<td>
Hasło usunięcia: </td><td> <input type="text" maxlength="12" name="kitten_name" style="width: 350px;" /> <input type="submit" value="wyślij" /></td>
</tr>
</table>
</form>
';


}//fi fid
else {
echo "Nie wybrano zdjecia do usuniecia";
}
?>
</div>
