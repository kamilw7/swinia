<div id="addcomment">
<form method="post" action="?page=register&action=add">
<table align="center">
<tr><td align="left">Skomentuj świnię:</td>
<tr><td><textarea name="kitten_desc" maxlength="300" type="text" id="kitten_desc" cols="70" style="height: 60px; width: 600px;"></textarea></td></tr>
<tr><td align="right"><br /><input type="submit" value="Kwik!"></td></tr>
</table></form>
</div>

<?php

require_once("classes/db/db.php");
	
$cmdb = new DBconn;

//===========================================================================//

function addcomment(){


}
