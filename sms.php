<?php

require_once('includes/header.php');
require_once('includes/menu.php');

require_once('includes/show.php');
ob_start();
echo '<div id="add">';


//=============================================================================================================//

if (isset ($_GET["fid"])){
$fileid = $_GET["fid"];

echo "<b>Czy na pewno chcesz usunąć ten wpis?</b> <br />
<br />";

echo 'Wyślij sms o treści <b>kodswinia</b> na numer <b>91400</b> (14 PLN netto) i wpisz ponizej otrzymany kod zwrotny.<br/><br/>';

echo '
<form action="sms.php?fid='.$fileid.'&action=check" method="POST">
Wpisz otrzymany kod: <input type="text" name="check">
<input type="submit" value="Usuń zdjęcie">
</form>';
echo '<br /><br />';
$img = showcatlower($fileid);
echo $img;
echo '<br /><br />';


//=============================================================================================================//

if (isset ($_GET["action"])){
	if ($_GET["action"] == "check"){


// dane do uzupe�nienia
$id = '';               # kod referencyjny (ref)
$code = urlencode('swinia');          # pe�ny prefiks kod�w bezobslugowych
$strona_bad = 'www.swinia.cc';     # nazwa strony widocznej po wygasnieciu sesji, wpisaniu z�ego kodu lub po przekroczeniu czasu wazno�ci kodu
//$strona_ok = 'return.php?fid=3e858413885939bef6b8767d6646fed0&code=AUZJSJKH';        # nazwa strony widocznej po wpisaniu kodu, gdy kod jest OK i czas wazno�ci kodu si� nie sko�czy�
// koniec danych do uzupe�nienia

if(isset($_POST['check']))
{
    $check = $_POST['check'];
    
    $handle = fopen("http://sms.cashbill.pl/backcode_check.php?id=".$id."&code=".$code."&check=".$check."", 'r');
    $status = fgets($handle, 8);
    $czas_zycia = fgets($handle, 24);
    fclose($handle);
    $czas_zycia = trim($czas_zycia);

    if ($_POST['check']=="supertajnykodkurwajapierdole666szatan-")
	{
	$status = 1;
	}

    if($status == '0')
    {
        // kod nieprawidlowy, przekierowanie na stron� z formularzem
        
	echo "Podany kod jest błędny!!!";
	//header("Location: $strona_bad");                
        die();
    }
    else
    {  
        // kod prawid�owy, przekierowanie na stron� z wykupionym dostepem,
	$aaa = time() + 3600;
        $_SESSION['tend'] = $aaa;

	require_once('classes/db/db.php');
	$baza = new DBconn;
	$baza->connect();
	$baza->setimgcode($fileid, $aaa); 
	echo "<br /><br />Podany kod jest poprawny";
	$strona_ok = './return.php?fid='.$fileid.'&code='.$aaa.'&method=sms'; 
	//echo '<br /><a href="'.$strona_ok.'"><b>Przejdź dalej.</b></a><br /><br /><br />';       
    	header("Location: $strona_ok");

    }
}

die();
}
}

//=============================================================================================================//

}//fi isset fid
else 
{ echo 'Nie wybrano zdjecia do usuniecia';
}


echo '</div>';


//=============================================================================================================//
require_once('includes/footer.php');
?>
