<div id="toolbar">

<?php

//TODO: dopisać ifa, jeżeli zalogowany to log out





if (isset($_SESSION["nick"])){
echo 'Jestes zalogowany jako: '. $_SESSION["nick"];
echo ' | <a href="?page=logout">Wyloguj się</a>';
}

else if (isset($_GET["page"])){
if ($_GET["page"]=="logout"){
echo '<a href="?page=register">Register</a> | <a href="?page=login">Log In</a>';
}

else {
echo '<a href="?page=register">Register</a> | <a href="?page=login">Log In</a>';
}

}

else {
echo '<a href="?page=register">Register</a> | <a href="?page=login">Log In</a>';
}
?>
</div>
