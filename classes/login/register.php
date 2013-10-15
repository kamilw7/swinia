
<?php 
// --------------------------------------- CAPTCHA -----------------------------------------//
//session_start();
$captcha_cond = 666;
if (!empty($_POST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {
        $captcha_message = "Invalid captcha";
	$captcha_cond = 578;
    } else {
        $captcha_message = "Valid captcha";
	$captcha_cond = 1;
    }

    $request_captcha = htmlspecialchars($_POST['captcha']);

    unset($_SESSION['captcha']);
}

// ------------------------------------ REGISTRATION -----------------------------------------//
require_once("classes/db/db.php");

//$baza = new DBconn;
$baza->connect();

if ($captcha_cond == 1){

$ip = $_SERVER['REMOTE_ADDR'];

$akcja = $_GET['action'];
    if ($akcja == 'add') {


$nick = substr(addslashes(htmlspecialchars($_POST['nick'])),0,32);
$haslo = substr(addslashes($_POST['haslo']),0,32);
$vhaslo = substr($_POST['vhaslo'],0,32);
$email = substr($_POST['email'],0,32);
$vemail = substr($_POST['vemail'],0,32);
$nick = trim($nick);


//kilka sprawdzen co do nicku i maila
//$spr1 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE nick='$nick' LIMIT 1")); //czy user o takim nicku istnieje
//$spr2 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$email' LIMIT 1")); // czy user o takim emailu istnieje
$pos = strpos($email, "@");
$pos2 = strpos($email, ".");
$emailx = explode("@", $email);
if ($emailx[1] == 'o2.pl') {
$emailx1 = $emailx[0].'@go2.pl';
$emailx2 = $emailx[0].'@tlen.pl';
//$spr3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$emailx1' OR `email`='$emailx2' LIMIT 1"));
}elseif ($emailx[1] == 'go2.pl') {
$emailx1 = $emailx[0].'@o2.pl';
$emailx2 = $emailx[0].'@tlen.pl';
//$spr3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$emailx1' OR `email`='$emailx2' LIMIT 1"));
}elseif ($emailx[1] == 'tlen.pl') {
$emailx1 = $emailx[0].'@go2.pl';
$emailx2 = $emailx[0].'@o2.pl';
//$spr3 = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM uzytkownicy WHERE email='$emailx1' OR `email`='$emailx2' LIMIT 1"));
}
$komunikaty = '';
$spr4 = strlen($nick);
$spr5 = strlen($haslo);


//sprawdzenie co uzytkownik zle zrobil
if (!$nick || !$email || !$haslo || !$vhaslo || !$vemail ) {
$komunikaty .= "Musisz wypełnić wszystkie pola!<br>"; }
if ($spr4 < 4) {
$komunikaty .= "Login musi mieć przynajmniej 4 znaki<br>"; }
if ($spr5 < 4) {
$komunikaty .= "Hasło musi mieć przynajmniej 4 znaki<br>"; }
/*
if ($spr1[0] >= 1) {
$komunikaty .= "Ten login jest zajęty!<br>"; }
if ($spr2[0] >= 1) {
$komunikaty .= "Ten e-mail jest już używany!<br>"; }
*/
if ($email != $vemail) {
$komunikaty .= "E-maile się nie zgadzają ...<br>";}
if ($haslo != $vhaslo) {
$komunikaty .= "Hasła się nie zgadzają ...<br>";}
if ($pos == false OR $pos2 == false) {
$komunikaty .= "Nieprawidłowy adres e-mail<br>"; }
/*
if ($spr3[0] >= 1) {
$komunikaty .= "Nie można zarejestrować kilku kont na jedną pocztę o2.<br>"; }
*/

//jesli cos jest nie tak to blokuje rejestracje i wyswietla bledy
if ($komunikaty) {
echo '
<b>Rejestracja nie powiodła się, popraw następujące błędy:</b><br>
'.$komunikaty.'<br>';

} else {

$nick = str_replace ( ' ','', $nick );
$haslo = md5($haslo); 
$time = time();

$baza->adduser($nick, $haslo, $email, $ip, $time);
adduser_echo();

}//fi komunikaty
}

}//fi captcha cond
else {
if ($captcha_cond == "578"){
echo "Zły kod captcha!";
}

//----------------------------------- FORM ----------------------------------------//
?>
<br />
<form method="post" action="?page=register&action=add">
<table align="center">
<tr><td>Twoja nazwa:</td>
<td><input maxlength="18" type="text" name="nick" value=""></td></tr>
<tr><td>Hasło:</td>
<td><input maxlength="32" type="password" name="haslo"></td></tr>
<tr><td>Powtórz hasło:</td>
<td><input maxlength="32" type="password" name="vhaslo"></td></tr>
<tr><td>E-mail:</td>
<td><input type="text" name="email" maxlength="50" value=""></td></tr>
<tr><td>Powtórz E-mail:</td>
<td><input type="text" maxlength="50" name="vemail" value=""></span></td></tr>

<tr>
<td colspan="2">

<br />
<img src="classes/captcha/captcha.php" id="captcha" /><br/>


<!-- CHANGE TEXT LINK -->
<a href="#" onclick="
    document.getElementById('captcha').src='classes/captcha/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Nieczytelne? Wygeneruj nowy.</a><br/><br/>

</td>
</tr>
<tr>
<td>
Przepisz kod:
</td>
<td>
<input type="text" name="captcha" id="captcha-form" autocomplete="off" style="width: 100px;" /><br/>
</td>
</tr>


<tr><td colspan="2" align="center"><br /><input type="submit" value="Zarejestruj"></td></tr>
<tr><td colspan="2" align="center"><br /><font size="1"><i>Tak, zapisujemy Twoje IP</i></font></tr>
</table></form>

<?php
}
//=====================================================================================//

function adduser_echo(){

echo '<br /><br /><span style="color: green; font-weight: bold;">Zostałeś zarejestrowany '.'. Teraz możesz się <a href="?page=login">zalogować</a></span><br /><br /><br>';


}
//=====================================================================================//
?>

