<?php



//===========================================================================//

function showcomment($fileid){

$baza = new DBconn;
$baza->connect();
$dane = $baza->getcomments($fileid);

foreach ($dane as $komentarz){

echo '<table align="center" width="700">
	<tr>
	<td width="50" align="left" bgcolor="pink">
	<font size="2">Świnia:</font>
	</td>
	<td width="350" bgcolor="pink" align="left"><font size="2">Komentarz:</font></td>
	<td bgcolor="pink" align="left"><font size="2">Dodał: '.$komentarz['author'].'</font></td>
	</tr>
	<tr>
	<td width="50"><img height="50" src="content/images/avatar.jpg" /></td>
	<td colspan="2" bgcolor="#f0f0f0">'
	.$komentarz['text'].'
	</td>
	</tr>
	<tr><td colspan="2" height="20"></td></tr>
	</table>';
}
 
}
