<?php

require ('classes/cb/cashbillInit.php');

require_once('classes/db/db.php');
require_once('includes/header.php');
require_once('includes/menu.php');
require_once('includes/show.php');

echo '<div id="add">';

echo '<font size="5"><b>Strona o podanym adresie nie istnieje!</b></font>';
echo '<br /><br />';
echo '<a href="./">powrót</a>';

echo '</div>';

require_once('includes/footer.php');
?>
