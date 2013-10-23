<?php
require_once('classes/rate/commentrate.php');


//===========================================================================//

function showcomment($fileid, $order){

$baza = new DBconn;
$baza->connect();
$dane = $baza->getcomments($fileid, $order);

foreach ($dane as $komentarz){

echo '<table align="center" width="700">
	<tr>
	<td width="50" align="left" bgcolor="pink">
	<font size="2">Świnia:</font>
	</td>
	<td bgcolor="pink" align="left"><font size="2">Komentarz:</font></td>
	<td bgcolor="pink" width="500" align="left"><font size="2">Dodał: '.$komentarz['author'].'</font></td>
	<td bgcolor="pink" align="left"><font size="2">'.showcommentrateicons($fileid, $komentarz['id']).'</font></td>
	</tr>
	<tr>
	<td width="50"><img height="50" src="content/images/avatar.jpg" /></td>
	<td colspan="3" bgcolor="#f0f0f0">'
	.$komentarz['text'].'
	</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	</table>';
}

}
