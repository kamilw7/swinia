<?
// dane do uzupelnienia
$strona_bad = 'index.html';     # nazwa strony widocznej po wygasnieciu sesji, wpisaniu z�ego kodu lub po przekroczeniu czasu wazno�ci kodu
// koniec danych do uzupe�nienia


if($_SESSION['tend'] < time())
{
    header("Location: $strona_bad");
    die();
}
?>
