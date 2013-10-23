<?php
require_once('content/contentheader.php');
require_once('classes/db/db.php');
?>
<div id="add">

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

//-------------------------------------------------------------------------------------------//

if (isset($_GET["action"])){

if ($_GET["action"] == "send"){
}

if ($captcha_cond == 1){

$topic = $_POST['mail_topic'];
$mail = $_POST['mail_mail'];
$text = $_POST['mail_text'];
$added = time();

$baza = new DBconn;
$baza->connect();
$baza->addmessage($topic, $mail, $text, $added);

echo "<br />Mail do obsługi został wysłany!<br /><br /></div>";

}//fi captcha cond
else {
echo '<a href="?page=contact">Zły captcha!</a><br /><br /></div>';
}//fi captcha cond


}

else {
?>

<form method="POST" action="?page=contact&action=send">

Zapytanie do Administratora :

<table align="center">
<tr><td>
Temat:
</td><td>
<input type="text" style="width: 400px" name="mail_topic" value="tu wpisz temat">
</td></tr>

<tr><td>
Twój e-mail:
</td><td>
<input type="text" style="width: 400px" name="mail_mail" value="tu wpisz Twoj mail">
</td></tr>


<tr><td>
Treść</td><td><textarea style="width: 400px; height: 200px;" name="mail_text" placeholder="tu wpisz treść wiadomości"></textarea>
</td></tr>
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
<input type="text" name="captcha" autocomplete="off" style="width: 400px;" /><br/>
</td>
</tr>
</table>
<input type="submit" value="wyślij">
</form>

</div>

<?php
}
require_once('content/contentfooter.php');
?>

<?php
require_once('content/contentheader.php');
require_once('classes/db/db.php');
?>
<div id="add">

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

//-------------------------------------------------------------------------------------------//

if (isset($_GET["action"])){

if ($_GET["action"] == "send"){
}

if ($captcha_cond == 1){

$topic = $_POST['mail_topic'];
$mail = $_POST['mail_mail'];
$text = $_POST['mail_text'];
$added = time();

$baza = new DBconn;
$baza->connect();
$baza->addmessage($topic, $mail, $text, $added);

echo "<br />Mail do obsługi został wysłany!<br /><br /></div>";

}//fi captcha cond
else {
echo '<a href="?page=contact">Zły captcha!</a><br /><br /></div>';
}//fi captcha cond


}

else {
?>

<form method="POST" action="?page=contact&action=send">

Zapytanie do Administratora :

<table align="center">
<tr><td>
Temat:
</td><td>
<input type="text" style="width: 400px" name="mail_topic" placeholder="tu wpisz temat">
</td></tr>

<tr><td>
Twój e-mail:
</td><td>
<input type="text" style="width: 400px" name="mail_mail" placeholder="tu wpisz Twoj mail">
</td></tr>


<tr><td>
Treść</td><td><textarea style="width: 400px; height: 200px;" name="mail_text" placeholder="tu wpisz treść wiadomości"></textarea>
</td></tr>
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
<input type="text" name="captcha" autocomplete="off" style="width: 400px;" /><br/>
</td>
</tr>
</table>
<input type="submit" value="wyślij">
</form>

</div>

<?php
}
require_once('content/contentfooter.php');
?>

