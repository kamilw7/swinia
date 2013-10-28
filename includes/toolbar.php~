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

<div id="searchtoolbar">
<form id="searchbox" method="post" action="?page=search&action=show">	
<input id="searcha" type="text" placeholder="Szukaj świnii" name="fraza" >
<input type="hidden" name="age" value="0">
<input type="hidden" name="locale" value="all">
<input id="submit" type="submit" value="Szukaj">
</form>
</div>
</div>


