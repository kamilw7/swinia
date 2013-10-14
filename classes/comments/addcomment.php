

<?php

require_once("classes/db/db.php");
	


//===========================================================================//

function showform($fid){
echo '
<div id="addcomment">
<form method="post" action="?page=show&fileid='.$fid.'&action=add">
<table align="center">
<tr><td align="left">Skomentuj świnię:</td>
<tr><td><textarea name="kitten_comment" maxlength="300" type="text" id="kitten_comment" cols="70" style="height: 60px; width: 600px;"></textarea></td></tr>
<tr><td align="right"><br /><input type="submit" value="Kwik!"></td></tr>
</table></form>
</div>
';


}

?>
