
<?php

/*
* SUPER GALERIA PIĘKNYCH KOTKÓW
* CATZ, KITTENZ, NO DOGZ
*/
session_start();

require_once('includes/header.php');

//------- polaczenie do bazy danych ---------//
require_once("classes/db/db.php");
$baza = new DBconn;
//$baza->connect();
//$baza->test();


if (isset($_GET["page"])){
switch ($_GET["page"])
{
case "add":
require_once('includes/add.php');
break;

case "login":
require_once('classes/login/login.php');
break;

case "logout":
require_once('classes/login/logout.php');
break;

case "register":
require_once('classes/login/register.php');
break;

case "show":
require_once('includes/img.php');
break;

case "remove":
require_once('includes/remove.php');
break;

default:
require_once('includes/page.php');
break;
}
}//fi isset page
else {
require_once('includes/page.php');
}


require_once('includes/footer.php');




?>
