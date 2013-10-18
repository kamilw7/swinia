<div id="add">
<?php

require_once('includes/show.php');

if (isset ($_GET["action"])){

if ($_GET["action"] == "remove"){
echo 'Zdjecie usuniete! Potwierdzono kodem:';
echo $_GET['code'];
}

if ($_GET["action"] == "confirmation"){
require_once('classes/cb/includes/cashbillPaycodeConfirmation.php');
}

}

if (isset ($_GET["fid"])){

$fileid = $_GET["fid"];

echo "<b>Czy na pewno chcesz usunąć tego kotka?</b> <br />
<br />";
$img = showcat($fileid);
echo $img;

echo "<br /><br />*<br /><br />";
echo "Zapłać sms:<br /><br />";

require_once('classes/cb/includes/cashbillPaycodeTransaction.php');

echo "<br /><br />*<br /><br />";

/*echo'

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
*/


}//fi fid
else {
echo "Nie wybrano zdjecia do usuniecia";
}
?>
</div>
