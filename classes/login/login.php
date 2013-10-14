<?php

if (isset($_GET["action"])){
if ($_GET["action"] == "open"){
}
}


if (!isset($_GET["action"])){

?>

<div id="content">
<form method="POST" action="?page=login&action=open">
<table align="center" cellpadding="0" cellspacing="0" width="180">

<tr><td><br></td><td></td><td></td></tr>
<tr><td width="50">Login:&nbsp&nbsp</td><td></td><td><input type="text" name="login" maxlength="32"></td></tr>
<tr><td><br></td><td></td><td></td></tr>
<tr><td width="50">Hasło:&nbsp&nbsp</td><td></td><td><input type="password" name="haslo" maxlength="32"></td></tr>


<?php

if (!isset ($_GET["redirect"])){
//do nothing
} else if (isset ($_GET["redirect"])){
echo '<input type="hidden" name="red" value="'.$_GET["redirect"].'">';
}//fi redirect
?>

<tr><td align="center" colspan="3"><br /><input type="submit" value="Zaloguj"><br></td></tr>



<?php
/*
if (!isset ($_GET["redirect"])){
//do nothing
} else if (isset ($_GET["redirect"])){
$string = 'Location: ./?page='.$_GET["redirect"];
header($string);
}//fi redirect

*/
?>
</table>
</form>
<br />
<p align="center">Nie masz jeszcze konta? <a href="?page=register">Zarejestruj się!</a>
</div>
<?php 
}

if (isset($_GET["action"])){
if ($_GET["action"] == "open"){


require_once("classes/db/db.php");

//$baza = new DBconn;
$baza->connect();

$login = $_POST['login'];
$haslo = $_POST['haslo'];
$haslo = addslashes($haslo);
$login = addslashes($login);
$login = htmlspecialchars($login);


if ($_GET['login'] != '') { //jezeli ktos przez adres probuje kombinowac
exit;
}
if ($_GET['haslo'] != '') { //jezeli ktos przez adres probuje kombinowac
exit;
}

$haslo = md5($haslo); //szyfrowanie hasla


/*    
if (!$login OR empty($login)) {
echo '<p class="alert">Wypełnij pole z loginem!</p>';
exit;
}

if (!$haslo OR empty($haslo)) {
echo '<p class="alert">Wypełnij pole z hasłem!</p>';
exit;
}
*/

//$istnick = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM `uzytkownicy` WHERE `nick` = '$login' AND `haslo` = '$haslo'")); // sprawdzenie czy istnieje uzytkownik o takim nicku i hasle

$istnick = $baza->isuser($login, $haslo);

if ($istnick == 0) {
echo 'Logowanie nieudane. Sprawdź pisownię nicku oraz hasła.';
} else {

$_SESSION['nick'] = $login;
$_SESSION['haslo'] = $haslo;

if (!isset ($_POST["red"])){
//do nothing
} else if (isset ($_POST["red"])){
$string = 'Location: ./?page='.$_POST["red"];
header($string);
}//fi redirect


}//fi istnick


}
}//fi action open

?>

