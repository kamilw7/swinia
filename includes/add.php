<?php
require_once("includes/menu.php");
require_once("includes/popular.php");
?>

<div id="add">
<?php
//-------------------------------------------------CAPTCHA----------------------------------------------------//
$zmiennaa = 1;
//if (isset($_SESSION["nick"])){

if ($zmiennaa){

//session_start();
$captcha_cond = 666;
if (!empty($_POST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['captcha']) {
        $captcha_message = "Invalid captcha";
        $style = "background-color: #FF606C";
    } else {
        $captcha_message = "Valid captcha";
        $style = "background-color: #CCFF99";
	$captcha_cond = 1;
    }

    $request_captcha = htmlspecialchars($_POST['captcha']);
/*
    echo <<<HTML
        <div id="result" style="$style">
        <h2>$captcha_message</h2>
        <table>
        <tr>
            <td>Session CAPTCHA:</td>
            <td>{$_SESSION['captcha']}</td>
        </tr>
        <tr>
            <td>Form CAPTCHA:</td>
            <td>$request_captcha</td>
        </tr>
        </table>
        </div>
HTML;
*/
    unset($_SESSION['captcha']);
}

//------------------------------------------------------------------------------------------------------------//

if (isset ($_POST['kitten_alttext'])) {

if ($_POST['kitten_alttext']=="www.swinia.cc") {

if (isset($_FILES['nazwa_pliku'])) {

if ($captcha_cond == 1){
/*echo "<br>";
echo $_FILES['nazwa_pliku']['type'];
echo "<br>";
echo $_FILES['nazwa_pliku']['size'];
echo "<br>";
echo $_FILES['nazwa_pliku']['name'];
echo "<br>";
echo $_FILES['nazwa_pliku']['tmp_name'];
echo "<br>";
echo $_FILES['nazwa_pliku']['error'];
echo "<br>";
*/


$blad = $_FILES['nazwa_pliku']['error'];
sprawdz_bledy($blad);
$typ = $_FILES['nazwa_pliku']['type'];
$typcond = sprawdz_typ($typ);

$name = $_POST["kitten_name"];
$subtitle = $_POST["kitten_subtitle"];
$desc = $_POST["kitten_desc"];
$fault = $_POST["kitten_fault"];
//$pass = $_POST["kitten_password"];
$pass = "kutas";
	if ($typcond == 1){	
	$imgpath = zapisz_plik();
	$imgpath = plik_as_poster($imgpath, $name, $subtitle);
	}

$path = $imgpath;

echo "Nazwa świni:";
echo $_POST["kitten_name"];
echo "<br />";
echo "Podpis obrazka:";
echo $_POST["kitten_subtitle"];
echo "<br />";
echo "Czym podpadła:";
echo $_POST["kitten_fault"];
echo "<br />";
echo "Opis świństwa:";
echo $_POST["kitten_desc"];
echo "<br />";
/*
echo "Twoje hasło usunięcia:<b>";
echo $_POST["kitten_password"];
echo "<br />";
*/
echo "Miasto:";
echo $_POST["kitten_locale"];
echo "<br />";
echo "Wiek:";
echo $_POST["kitten_age"];
echo "<br />";

echo "</b>Zdjęcie świnii:";
echo '<br/ ><img src="'.$imgpath.'" />';
echo '<br /><br /><a href="./?page=show&fileid='.md5($path).'">Przejdź do strony zdjęcia</a>';

$imgid = md5($path);

add_to_db($name, $desc, $fault, $path, $pass);
add_to_meta($imgid, $_POST["kitten_locale"], $_POST["kitten_age"], $name, $_POST["kitten_street"]);

}//fi captcha_cond
else {
echo '<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
      <input type="hidden" name="form_kitten_name" value="'.$_POST["kitten_name"].'" />
      <input type="hidden" name="form_kitten_subtitle" value="'.$_POST["kitten_subtitle"].'" />
      <input type="hidden" name="form_kitten_fault" value="'.$_POST["kitten_fault"].'" />
      <input type="hidden" name="form_kitten_desc" value="'.$_POST["kitten_desc"].'" />
	<input type="hidden" name="form_kitten_street" value="'.$_POST["kitten_street"].'" />';

if (isset($_POST["kitten_file"])){
      echo '<input type="hidden" name="form_kitten_file" value="'.$_POST["kitten_file"].'" />'; }
if (isset($_POST["kitten_password"])){
      echo '<input type="hidden" name="form_kitten_password" value="'.$_POST["kitten_password"].'" />'; }

echo '<input type="hidden" name="form_kitten_alttext" value="'.$_POST["kitten_alttext"].'" />';
echo '<input style="width: 400px" type="submit" value="Niepoprawny captcha. Wypełnij formularz ponownie" />';
} //esle fi captcha_cond


}// fi isset file[nazwapliku];

}//kitten alttext !=NULL

// ################################################################################################## //


else {

if ($captcha_cond == 1){
/*echo "<br>";
echo $_FILES['nazwa_pliku']['type'];
echo "<br>";
echo $_FILES['nazwa_pliku']['size'];
echo "<br>";
echo $_FILES['nazwa_pliku']['name'];
echo "<br>";
echo $_FILES['nazwa_pliku']['tmp_name'];
echo "<br>";
echo $_FILES['nazwa_pliku']['error'];
echo "<br>";
*/


//$blad = $_FILES['nazwa_pliku']['error'];
//sprawdz_bledy($blad);
//$typ = $_FILES['nazwa_pliku']['type'];
//$typcond = sprawdz_typ($typ);

$name = $_POST["kitten_name"];
$subtitle = $_POST["kitten_subtitle"];
$desc = $_POST["kitten_desc"];
$fault = $_POST["kitten_fault"];
//$pass = $_POST["kitten_password"];
$pass = "kutas";

$alttext = $_POST["kitten_alttext"];
		
$imgpath = zapisz_alttext($alttext);
$imgpath = text_as_jpg($imgpath, $alttext);
$imgpath = plik_as_poster($imgpath, $name, $subtitle);	

$path = $imgpath;

echo "Nazwa świni:";
echo $_POST["kitten_name"];
echo "<br />";
echo "Podpis obrazka:";
echo $_POST["kitten_subtitle"];
echo "<br />";
echo "Czym podpadła:";
echo $_POST["kitten_fault"];
echo "<br />";
echo "Opis świństwa:";
echo $_POST["kitten_desc"];
echo "<br />";
/*
echo "Twoje hasło usunięcia:<b>";
echo $_POST["kitten_password"];
echo "<br />";
*/
echo "Miasto:";
echo $_POST["kitten_locale"];
echo "<br />";
echo "Wiek:";
echo $_POST["kitten_age"];
echo "<br />";

echo "</b>Zdjęcie świnii:";
echo '<br/ ><img src="'.$imgpath.'" />';
echo '<br /><br /><a href="./?page=show&fileid='.md5($path).'">Przejdź do strony zdjęcia</a>';

$imgid = md5($path);

add_to_db($name, $desc, $fault, $path, $pass);
add_to_meta($imgid, $_POST["kitten_locale"], $_POST["kitten_age"], $name);

}//fi captcha_cond
else {
echo '<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
      <input type="hidden" name="form_kitten_name" value="'.$_POST["kitten_name"].'" />
      <input type="hidden" name="form_kitten_subtitle" value="'.$_POST["kitten_subtitle"].'" />
      <input type="hidden" name="form_kitten_fault" value="'.$_POST["kitten_fault"].'" />
      <input type="hidden" name="form_kitten_desc" value="'.$_POST["kitten_desc"].'" />
	<input type="hidden" name="form_kitten_street" value="'.$_POST["kitten_street"].'" />';

if (isset($_POST["kitten_file"])){
      echo '<input type="hidden" name="form_kitten_file" value="'.$_POST["kitten_file"].'" />'; }
if (isset($_POST["kitten_password"])){
      echo '<input type="hidden" name="form_kitten_password" value="'.$_POST["kitten_password"].'" />'; }

echo '<input type="hidden" name="form_kitten_alttext" value="'.$_POST["kitten_alttext"].'" />';
echo '<input type="submit" value="Niepoprawny captcha. Wypełnij formularz ponownie" />';
} //esle fi captcha_cond

}// else fi !isset file[nazwapliku];
}// isset kitten_alttext

// #################################################################################################### //

else {

?>

<p align="center"><b>Dodaj nową świnię</b></p>
<p align="center"><font size="2">Dodanie nowego wpisu wiąże się z akceptacją regulaminu i założeń serwisu www.swinia.cc</font></p>
<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="5120000000" />
<table align="center" width="600">
<tr>
<td align="left">
Imię (i nazwisko) świnii: </td><td> <input type="text" autocomplete="off" maxlength="28" name="kitten_name" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_name'])) echo $_POST['form_kitten_name']; ?>" /> </td>
</tr>
<tr>
<td align="left">
Podpis na obrazek: </td><td> <input type="text" maxlength="90" name="kitten_subtitle" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_subtitle'])) echo $_POST['form_kitten_subtitle']; ?>" /> </td>
</tr>
<tr>
<td align="left">
Czym podpadła: </td><td>  <textarea name="kitten_fault" maxlength="200" type="text" id="kitten_desc" cols="70" style="height: 100px; width: 400px;"><?php if (isset($_POST['form_kitten_fault'])) echo $_POST['form_kitten_fault']; ?></textarea></td>
</tr>
<tr>
<td align="left">
Opis: </td><td>  <textarea name="kitten_desc" maxlength="200" type="text" id="kitten_desc" cols="70" style="height: 100px; width: 400px;"><?php if (isset($_POST['form_kitten_desc'])) echo $_POST['form_kitten_desc']; ?></textarea></td>
</tr>


<tr>
<td align="left">
Miasto: </td>
<td> 

<select style="width: 400px;" name="kitten_locale">
<option value="all"> ------ wszystkie ------ </option>
<option value="Aleksandrów Łódzki">Aleksandrów Łódzki</option>
<option value="Augustów">Augustów</option>
<option value="Bełchatów">Bełchatów</option>
<option value="Będzin">Będzin</option>
<option value="Biała Podlaska">Biała Podlaska</option>
<option value="Białogard">Białogard</option>
<option value="Biały Bór">Biały Bór</option>
<option value="Bielsk Podlaski">Bielsk Podlaski</option>
<option value="Bielsko Biała">Bielsko Biała</option>
<option value="Bierutów">Bierutów</option>
<option value="Bieżuń">Bieżuń</option>
<option value="Bochnia">Bochnia</option>
<option value="Bogatynia">Bogatynia</option>
<option value="Bolesławiec">Bolesławiec</option>
<option value="Bolków">Bolków</option>
<option value="Braniewo">Braniewo</option>
<option value="Brodnica">Brodnica</option>
<option value="Brusy">Brusy</option>
<option value="Brzeg">Brzeg</option>
<option value="Bukowno">Bukowno</option>
<option value="Bydgoszcz">Bydgoszcz</option>
<option value="Bytom">Bytom</option>
<option value="Bytów">Bytów</option>
<option value="Chełm">Chełm</option>
<option value="Chełmża">Chełmża</option>
<option value="Chocianów">Chocianów</option>
<option value="Chodzież">Chodzież</option>
<option value="Chojnów">Chojnów</option>
<option value="Chorzów">Chorzów</option>
<option value="Choszczno">Choszczno</option>
<option value="Ciechanów">Ciechanów</option>
<option value="Ciechocinek">Ciechocinek</option>
<option value="Cieszyn">Cieszyn</option>
<option value="Czechowice Dziedzice">Czechowice Dziedzice</option>
<option value="Czelad ź">Czelad ź</option>
<option value="Czersk">Czersk</option>
<option value="Częstochowa">Częstochowa</option>
<option value="Człuchów">Człuchów</option>
<option value="Dąbie">Dąbie</option>
<option value="Dąbrowa Górnicza">Dąbrowa Górnicza</option>
<option value="Dęblin">Dęblin</option>
<option value="Dębno">Dębno</option>
<option value="Dolsk">Dolsk</option>
<option value="Drawsko Pomorskie">Drawsko Pomorskie</option>
<option value="Dukla">Dukla</option>
<option value="Działdowo">Działdowo</option>
<option value="Dzierżoniów">Dzierżoniów</option>
<option value="Elbląg">Elbląg</option>
<option value="Ełk">Ełk</option>
<option value="Gdańsk">Gdańsk</option>
<option value="Gdynia">Gdynia</option>
<option value="Giżycko">Giżycko</option>
<option value="Głogów">Głogów</option>
<option value="Głowno">Głowno</option>
<option value="Gniezno">Gniezno</option>
<option value="Golub Dobrzyń">Golub Dobrzyń</option>
<option value="Gołdap">Gołdap</option>
<option value="Gorzów Wielkopolski">Gorzów Wielkopolski</option>
<option value="Gostyń">Gostyń</option>
<option value="Grajewo">Grajewo</option>
<option value="Grodzisk Mazowiecki">Grodzisk Mazowiecki</option>
<option value="Grodzisk Wielkopolski">Grodzisk Wielkopolski</option>
<option value="Grudziądz">Grudziądz</option>
<option value="Iława">Iława</option>
<option value="Iłża">Iłża</option>
<option value="Inowrocław">Inowrocław</option>
<option value="Jarocin">Jarocin</option>
<option value="Jarosław">Jarosław</option>
<option value="Jasło">Jasło</option>
<option value="Jastrzębie Zdrój">Jastrzębie Zdrój</option>
<option value="Jawor">Jawor</option>
<option value="Jaworzno">Jaworzno</option>
<option value="Jedlina Zdrój">Jedlina Zdrój</option>
<option value="Jelenia Góra">Jelenia Góra</option>
<option value="Józefów">Józefów</option>
<option value="Kalisz">Kalisz</option>
<option value="Kalisz Pomorski">Kalisz Pomorski</option>
<option value="Kamień Krajeński">Kamień Krajeński</option>
<option value="Karpacz">Karpacz</option>
<option value="Kartuzy">Kartuzy</option>
<option value="Katowice">Katowice</option>
<option value="Kędzierzyn Ko źle">Kędzierzyn Ko źle</option>
<option value="Kępice">Kępice</option>
<option value="Kępno">Kępno</option>
<option value="Kielce">Kielce</option>
<option value="Kleczew">Kleczew</option>
<option value="Kluczbork">Kluczbork</option>
<option value="Kłodzko">Kłodzko</option>
<option value="Kolbuszowa">Kolbuszowa</option>
<option value="Kolno">Kolno</option>
<option value="Koło">Koło</option>
<option value="Kołobrzeg">Kołobrzeg</option>
<option value="Konin">Konin</option>
<option value="Kostrzyn">Kostrzyn</option>
<option value="Koszalin">Koszalin</option>
<option value="Kościan">Kościan</option>
<option value="Kozienice">Kozienice</option>
<option value="Ko źmin Wielkopolski">Ko źmin Wielkopolski</option>
<option value="Kórnik">Kórnik</option>
<option value="Kraków">Kraków</option>
<option value="Kraśnik">Kraśnik</option>
<option value="Krotoszyn">Krotoszyn</option>
<option value="Kruszwica">Kruszwica</option>
<option value="Książ Wielkopolski">Książ Wielkopolski</option>
<option value="Kutno">Kutno</option>
<option value="Kwidzyn">Kwidzyn</option>
<option value="Legionowo">Legionowo</option>
<option value="Legnica">Legnica</option>
<option value="Leszno">Leszno</option>
<option value="Leżajsk">Leżajsk</option>
<option value="Lębork">Lębork</option>
<option value="Libiąż">Libiąż</option>
<option value="Limanowa">Limanowa</option>
<option value="Lubaczów">Lubaczów</option>
<option value="Lubań">Lubań</option>
<option value="Lubartów">Lubartów</option>
<option value="Lubawa">Lubawa</option>
<option value="Lubin">Lubin</option>
<option value="Lublin">Lublin</option>
<option value="Lubliniec">Lubliniec</option>
<option value="Lwówek Śląski">Lwówek Śląski</option>
<option value="Łaskarzew">Łaskarzew</option>
<option value="Łeba">Łeba</option>
<option value="Łomża">Łomża</option>
<option value="Łosice">Łosice</option>
<option value="Łowicz">Łowicz</option>
<option value="Łód ź">Łód ź</option>
<option value="Łuków">Łuków</option>
<option value="Malbork">Malbork</option>
<option value="Marki">Marki</option>
<option value="Miastko">Miastko</option>
<option value="Mielec">Mielec</option>
<option value="Mieszkowice">Mieszkowice</option>
<option value="Międzylesie">Międzylesie</option>
<option value="Międzyrzec Podlaski">Międzyrzec Podlaski</option>
<option value="Międzyzdroje">Międzyzdroje</option>
<option value="Milanówek">Milanówek</option>
<option value="Mińsk Mazowiecki">Mińsk Mazowiecki</option>
<option value="Mława">Mława</option>
<option value="Morąg">Morąg</option>
<option value="Mrocza">Mrocza</option>
<option value="Mszana Dolna">Mszana Dolna</option>
<option value="Mszczonów">Mszczonów</option>
<option value="Mysłowice">Mysłowice</option>
<option value="Myszków">Myszków</option>
<option value="Myślenice">Myślenice</option>
<option value="Nakło">Nakło</option>
<option value="Nidzica">Nidzica</option>
<option value="Niepołomice">Niepołomice</option>
<option value="Nowa Dęba">Nowa Dęba</option>
<option value="Nowa Ruda">Nowa Ruda</option>
<option value="Nowa Sól">Nowa Sól</option>
<option value="Nowe">Nowe</option>
<option value="Nowogard">Nowogard</option>
<option value="Nowy Sącz">Nowy Sącz</option>
<option value="Nowy Tomyśl">Nowy Tomyśl</option>
<option value="Nysa">Nysa</option>
<option value="Oborniki">Oborniki</option>
<option value="Odolanów">Odolanów</option>
<option value="Oleśnica">Oleśnica</option>
<option value="Olkusz">Olkusz</option>
<option value="Olsztyn">Olsztyn</option>
<option value="Opole">Opole</option>
<option value="Ostroróg">Ostroróg</option>
<option value="Ostrowiec Świętokrzyski">Ostrowiec Świętokrzyski</option>
<option value="Ostróda">Ostróda</option>
<option value="Ostrów Mazowiecka">Ostrów Mazowiecka</option>
<option value="Ostrów Wielkopolski">Ostrów Wielkopolski</option>
<option value="Ostrzeszów">Ostrzeszów</option>
<option value="Oświęcim">Oświęcim</option>
<option value="Otwock">Otwock</option>
<option value="Pabianice">Pabianice</option>
<option value="Pelplin">Pelplin</option>
<option value="Piaseczno">Piaseczno</option>
<option value="Piastów">Piastów</option>
<option value="Piekary Śląskie">Piekary Śląskie</option>
<option value="Piła">Piła</option>
<option value="Piława Górna">Piława Górna</option>
<option value="Pionki">Pionki</option>
<option value="Piotrków Trybunalski">Piotrków Trybunalski</option>
<option value="Pleszew">Pleszew</option>
<option value="Płock">Płock</option>
<option value="Płońsk">Płońsk</option>
<option value="Police">Police</option>
<option value="Polkowice">Polkowice</option>
<option value="Połaniec">Połaniec</option>
<option value="Poniec">Poniec</option>
<option value="Poznań">Poznań</option>
<option value="Pruszcz Gdański">Pruszcz Gdański</option>
<option value="Przemyśl">Przemyśl</option>
<option value="Przeworsk">Przeworsk</option>
<option value="Puławy">Puławy</option>
<option value="Puszczykowo">Puszczykowo</option>
<option value="Racibórz">Racibórz</option>
<option value="Radom">Radom</option>
<option value="Radomsko">Radomsko</option>
<option value="Radzyń Podlaski">Radzyń Podlaski</option>
<option value="Rawa Mazowiecka">Rawa Mazowiecka</option>
<option value="Rawicz">Rawicz</option>
<option value="Reda">Reda</option>
<option value="Rogo źno">Rogo źno</option>
<option value="Ruda Śląska">Ruda Śląska</option>
<option value="Rumia">Rumia</option>
<option value="Rybnik">Rybnik</option>
<option value="Rydzyna">Rydzyna</option>
<option value="Rypin">Rypin</option>
<option value="Rzeszów">Rzeszów</option>
<option value="Sandomierz">Sandomierz</option>
<option value="Sanok">Sanok</option>
<option value="Serock">Serock</option>
<option value="Sępólno Krajeńskie">Sępólno Krajeńskie</option>
<option value="Siedlce">Siedlce</option>
<option value="Siemianowice Śląskie">Siemianowice Śląskie</option>
<option value="Sieradz">Sieradz</option>
<option value="Sieraków">Sieraków</option>
<option value="Skarżysko Kamienna">Skarżysko Kamienna</option>
<option value="Skawina">Skawina</option>
<option value="Skierniewice">Skierniewice</option>
<option value="Skoczów">Skoczów</option>
<option value="Skwierzyna">Skwierzyna</option>
<option value="Słubice">Słubice</option>
<option value="Słupsk">Słupsk</option>
<option value="Sochaczew">Sochaczew</option>
<option value="Sokołów Podlaski">Sokołów Podlaski</option>
<option value="Sokółka">Sokółka</option>
<option value="Sopot">Sopot</option>
<option value="Sosnowiec">Sosnowiec</option>
<option value="Starachowice">Starachowice</option>
<option value="Stargard Szczeciński">Stargard Szczeciński</option>
<option value="Starogard Gdański">Starogard Gdański</option>
<option value="Stary Sącz">Stary Sącz</option>
<option value="Strzelce Krajeńskie">Strzelce Krajeńskie</option>
<option value="Sulejówek">Sulejówek</option>
<option value="Sulęcin">Sulęcin</option>
<option value="Sulmierzyce">Sulmierzyce</option>
<option value="Suwałki">Suwałki</option>
<option value="Swarzędz">Swarzędz</option>
<option value="Syców">Syców</option>
<option value="Szamotuły">Szamotuły</option>
<option value="Szczawnica">Szczawnica</option>
<option value="Szczawno Zdrój">Szczawno Zdrój</option>
<option value="Szczecin">Szczecin</option>
<option value="Szczecinek">Szczecinek</option>
<option value="Szczytno">Szczytno</option>
<option value="Ślesin">Ślesin</option>
<option value="Śrem">Śrem</option>
<option value="Świdnica">Świdnica</option>
<option value="Świdnik">Świdnik</option>
<option value="Świecie">Świecie</option>
<option value="Świętochłowice">Świętochłowice</option>
<option value="Świnoujście">Świnoujście</option>
<option value="Tarnobrzeg">Tarnobrzeg</option>
<option value="Tarnów">Tarnów</option>
<option value="Tłuszcz">Tłuszcz</option>
<option value="Tomaszów Mazowiecki">Tomaszów Mazowiecki</option>
<option value="Toruń">Toruń</option>
<option value="Trzcianka">Trzcianka</option>
<option value="Trzebinia">Trzebinia</option>
<option value="Tuchola">Tuchola</option>
<option value="Tuczno">Tuczno</option>
<option value="Turek">Turek</option>
<option value="Tychy">Tychy</option>
<option value="Ustka">Ustka</option>
<option value="Ustroń">Ustroń</option>
<option value="Wałbrzych">Wałbrzych</option>
<option value="Warszawa">Warszawa</option>
<option value="Wąbrzeźno">Wąbrzeźno</option>
<option value="Wągrowiec">Wągrowiec</option>
<option value="Wejherowo">Wejherowo</option>
<option value="Węgrów">Węgrów</option>
<option value="Wieliczka">Wieliczka</option>
<option value="Wieruszów">Wieruszów</option>
<option value="Więcbork">Więcbork</option>
<option value="Włocławek">Włocławek</option>
<option value="Wolsztyn">Wolsztyn</option>
<option value="Wołomin">Wołomin</option>
<option value="Września">Września</option>
<option value="Wyrzysk">Wyrzysk</option>
<option value="Wysokie Mazowieckie">Wysokie Mazowieckie</option>
<option value="Zabrze">Zabrze</option>
<option value="Zakopane">Zakopane</option>
<option value="Zambrów">Zambrów</option>
<option value="Zamość">Zamość</option>
<option value="Zawidów">Zawidów</option>
<option value="Zawiercie">Zawiercie</option>
<option value="Ząbki">Ząbki</option>
<option value="Zbąszynek">Zbąszynek</option>
<option value="Zduny">Zduny</option>
<option value="Zduńska Wola">Zduńska Wola</option>
<option value="Zelów">Zelów</option>
<option value="Zgierz">Zgierz</option>
<option value="Zgorzelec">Zgorzelec</option>
<option value="Zielona Góra">Zielona Góra</option>
<option value="Zielonka">Zielonka</option>
<option value="Ziębice">Ziębice</option>
<option value="Złocieniec">Złocieniec</option>
<option value="Złotoryja">Złotoryja</option>
<option value="Złotów">Złotów</option>
<option value="Żagań">Żagań</option>
<option value="Żerków">Żerków</option>
<option value="Żmigród">Żmigród</option>
<option value="Żnin">Żnin</option>
<option value="Żory">Żory</option>
<option value="Żyrardów">Żyrardów</option>
<option value="Żywiec">Żywiec</option>
</select>
</td>
</tr>

<td align="left">
Ulica: </td><td>  <textarea name="kitten_street" maxlength="200" type="text" id="kitten_street" cols="70" style="width: 400px;"><?php if (isset($_POST['form_kitten_street'])) echo $_POST['form_kitten_street']; ?></textarea></td>
</tr>

<tr height="30">
<td align="left">
Wiek: </td><td>

<select name="kitten_age" style="width: 400px;">
<option value="0"> ------ wszystkie ------ </option>
<?php 
for($value = 1; $value <= 100; $value++){ 
    echo('<option value="' . $value . '">' . $value . '</option>');
}


?>
</select>

</td>
</tr>


<tr height="80">
<td align="left">
Portret świnii:
</td>
<td width="400">
<input type="file" name="nazwa_pliku" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_file'])) echo $_POST['form_kitten_file']; ?>" />
<font size="2">Jeśli nie masz zdjęcia świnii, wpisz tekst alternatywny w polu poniżej - zostanie on dodany zamiast zdjęcia. </font></td>
</tr>
<tr>
<td align="left">
Tekst alternatywny: </td><td>  <textarea name="kitten_alttext" maxlength="200" type="text" id="kitten_alttext" cols="70" style="height: 60px; width: 400px;">
<?php if (isset($_POST['form_kitten_alttext'])) {
	echo $_POST['form_kitten_alttext']; } 
      else { echo 'www.swinia.cc'; }?></textarea><font size="2">To pole pozostaw niezmienione, jeśli dodałeś portret świnii. W przeciwnym razie, użyj formy opisowej, np. "Chuck Norris w kapeluszu".</font></td></td>
</tr>
<?php
/*
<tr>
<td align="left">
Hasło usunięcia: </td><td> <input type="text" maxlength="12" name="kitten_password" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_password'])) echo $_POST['form_kitten_password']; ?>" /> </td>
</tr>
*/
?>



<tr>
<td align="left">

</td>
</tr>

<tr>
<td align="left">
Kod świnii:
</td>
<td>

<br />
<img src="classes/captcha/captcha.php" id="captcha" /><br/>


<!-- CHANGE TEXT LINK -->
<a href="#" onclick="
    document.getElementById('captcha').src='classes/captcha/captcha.php?'+Math.random();
    document.getElementById('captcha-form').focus();"
    id="change-image">Not readable? Change text.</a><br/><br/>

</td>
</tr>
<tr>
<td align="left">
Przepisz kod świnii:
</td>
<td>
<input type="text" name="captcha" style="width: 400px;" /><br/>
</td>
</tr>

<tr>
<td colspan="2">
<br />
<input type="submit" value="wyślij" />
</td>
</tr>
</table>
</form>
<br />

<?php

} //else isset file[nazwapliku]

} else { echo '<a href="?page=login&redirect=add">Zaloguj sie!</a>'; } //fi $zmiennaa

//===============================================================================================//
								//===============================================================================================//


function add_to_db($name, $desc, $fault, $path, $pass){
	require_once("classes/db/db.php");
	
	$baza = new DBconn;

	$baza->connect();
	$added = time();
	if (!isset($_SESSION['nick'])){
	$user = "Anonymous";
	} else {
	$user = $_SESSION['nick'];
	}
	$fileid = md5($path);
	$rate = 0;
	$visible = 1;
	$code = 00000000;

	$baza->addcat($name, $desc, $path, $fileid, $user, $added, $pass, $rate, $fault, $visible, $code);


}
//===============================================================================================//

function add_to_meta($fileid, $locale, $age, $name, $street){
	require_once("classes/db/db.php");
	
	$baza = new DBconn;

	$baza->connect();
	$baza->addcatmeta($fileid, $locale, $age, $name, $street);


}
//===============================================================================================//


function plik_as_poster($filename, $title, $subtitle){

	$znakwodny = "content/images/watermark.png";
	$source = $filename;
	$thumb = $filename.'thumb';
	$pageimg = $filename.'main';
    	$dirpath = dirname($filename);

	//echo $dirpath;
	
	exec('convert -geometry 500x '.$source.' '.$source);
	exec('convert -geometry 100x -crop 100x100+0+0+repage '.$thumb.' '.$thumb);
	exec('convert '.$thumb.' -resize 100x100^ -gravity Center -crop 100x100+0+0 +repage '.$thumb);
	exec('convert '.$pageimg.' -resize 500x500^ -gravity Center -crop 500x500+0+0 +repage '.$pageimg);


	$command = 'composite -dissolve 50% -gravity southeast -quality 100 ' . $znakwodny . ' ' . $source . ' ' . $source;
	shell_exec($command);
       
	exec('convert '.$source.'  -bordercolor \'#940081\' -border 3x3 '.$source); // add small black border
        exec('convert '.$source.'  -bordercolor white -border 2x2 '.$source); // add white line around the image
        exec('convert '.$source.'  -bordercolor \'#940081\' -border 75x75 '.$source); //add a wide black border around

        exec('convert '.$source.' -size 15x15 xc:\'#940081\' -background \'#940081\' -append  -pointsize 48 -fill white -draw "gravity North text 0,10 \'' .$title. '\'" '.$source);
	//exec('convert '.$source.'  -bordercolor \'#940081\' -border 0%x5% text2.ppm'); //add a wide black border around

	$subtitle = wordwrap($subtitle, 40, "\n");
        exec('convert '.$source.' -size 15x15 xc:\'#940081\' -background \'#940081\' -append  -pointsize 32 -fill white -draw "gravity South text 0,10 \'' .$subtitle. '\'" '.$source);
   
     return $source;


}

//===============================================================================================//



function text_as_jpg($filename, $text){


	$source = $filename;
	$thumb = $filename.'thumb';
	$pageimg = $filename.'main';
    	$dirpath = dirname($filename);

	$text = addslashes($text);
	$nowytekst = wordwrap($text, 25, "\n");


	
	exec('convert -size 400x400 xc:black -font Arial -pointsize 28 -fill \'#940081\' -gravity center -stroke white -draw "text 0,0 \''.$nowytekst.'\'" '.$source);
	exec('convert '.$source.' -resize 100x100^ -gravity Center -crop 100x100+0+0 +repage '.$thumb);
	exec('convert '.$source.' -resize 500x500^ -gravity Center -crop 500x500+0+0 +repage '.$pageimg);

   
     return $source;


}

//===============================================================================================//




function zapisz_plik()
{

$cfg['dir_name'] = md5($_POST["kitten_name"].time());
$cfg['file_name'] = 'index.php';


$dir = $cfg['dir_name'];

if(mkdir('files/'.$cfg['dir_name'], 0777))
{

 if(touch('files/'.$cfg['dir_name'].'/'.$cfg['file_name']))
 {
  // Odczyt i zapis dla właściciela, żadnych praw dla innych
  if(chmod('files/'.$cfg['dir_name'].'/'.$cfg['file_name'], 0600))
  {
   //echo 'Stworzono folder i plik oraz nadano prawa dostępu';
 	echo 'Upload OK <br />';
  }
  else
  {
   //echo 'Stworzono folder i plik jednak nie udało się nadać praw dostępu';
  }

 }
 else
 {
  echo 'Nie udało się stworzyć pliku';
 }
 
}
else
{
 echo 'Nie udało się stworzyć katalogu';
}
 
 $typ = $_FILES['nazwa_pliku']['type'];
 if ($typ == 'image/jpeg'){
		$typ = ".jpg";}
 else if ($typ == 'image/png'){
		$typ = ".png";}
 
  $lokalizacja = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ;
    $lokalizacja1 = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ . 'thumb';
	    $lokalizacja2 = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ . 'main';
	
  if(is_uploaded_file($_FILES['nazwa_pliku']['tmp_name']))
  {
    
    if(!move_uploaded_file($_FILES['nazwa_pliku']['tmp_name'], $lokalizacja))
    {
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
        return false;  
    }
    else {
	exec('cp '.$lokalizacja.' '.$lokalizacja1);
	exec('cp '.$lokalizacja.' '.$lokalizacja2);
 	}
	
  }
  else
  {
    echo 'problem: Możliwy atak podczas przesyłania pliku.';
	echo 'Plik nie został zapisany.';
    return false;
  }
  return $lokalizacja;
}


//===============================================================================================//


function zapisz_alttext()
{


$cfg['dir_name'] = md5($_POST["kitten_name"].time());
$cfg['file_name'] = 'index.php';


$dir = $cfg['dir_name'];

if(mkdir('files/'.$cfg['dir_name'], 0777))
{

 if(touch('files/'.$cfg['dir_name'].'/'.$cfg['file_name']))
 {
  // Odczyt i zapis dla właściciela, żadnych praw dla innych
  if(chmod('files/'.$cfg['dir_name'].'/'.$cfg['file_name'], 0600))
  {
   //echo 'Stworzono folder i plik oraz nadano prawa dostępu';
 	echo 'Upload OK <br />';
  }
  else
  {
   //echo 'Stworzono folder i plik jednak nie udało się nadać praw dostępu';
  }

 }
 else
 {
  echo 'Nie udało się stworzyć pliku';
 }
 
}
else
{
 echo 'Nie udało się stworzyć katalogu';
}
 
$typ = ".jpg";
 
$lokalizacja = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ;
$lokalizacja1 = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ . 'thumb';
$lokalizacja2 = 'files/'. $dir . '/' . md5('plik_obrazkowy') . $typ . 'main';


 //-----------------------------------------------------------------------------//
 if(touch($lokalizacja))
 {
  // Odczyt i zapis dla właściciela, żadnych praw dla innych
  if(chmod($lokalizacja, 0777))
  {
   //echo 'Stworzono folder i plik oraz nadano prawa dostępu';
 	echo 'Upload OK <br />';
  }
  else
  {
   //echo 'Stworzono folder i plik jednak nie udało się nadać praw dostępu';
  }

 }
 else
 {
  echo 'Nie udało się stworzyć pliku';
 }
 //-----------------------------------------------------------------------------/
 if(touch($lokalizacja1))
 {
  // Odczyt i zapis dla właściciela, żadnych praw dla innych
  if(chmod($lokalizacja1, 0777))
  {
   //echo 'Stworzono folder i plik oraz nadano prawa dostępu';
 	echo ' ';
  }
  else
  {
   //echo 'Stworzono folder i plik jednak nie udało się nadać praw dostępu';
  }

 }
 else
 {
  echo 'Nie udało się stworzyć pliku';
 }
 //-----------------------------------------------------------------------------/
 if(touch($lokalizacja2))
 {
  // Odczyt i zapis dla właściciela, żadnych praw dla innych
  if(chmod($lokalizacja2, 0777))
  {
   //echo 'Stworzono folder i plik oraz nadano prawa dostępu';
 	echo ' ';
  }
  else
  {
   //echo 'Stworzono folder i plik jednak nie udało się nadać praw dostępu';
  }

 }
 else
 {
  echo 'Nie udało się stworzyć pliku';
 }

 return $lokalizacja;
}


//===============================================================================================//

function sprawdz_typ($typ)
{

 if ($typ == 'image/jpeg'){
		return 1;}
 else if ($typ == 'image/png'){
		return 1;}
 else {
	        echo '<br><br><font color="red">Typ pliku różny od JPEG lub PNG</font>';
		return 0;}

}

//================================================================================================//

function sprawdz_bledy($blad)
{
  if ($blad > 0)
  {
    echo '<br><br><font color="red">';
    echo 'problem: ';
    switch ($_FILES['obrazek']['error'])
    {
      // jest większy niż domyślny maksymalny rozmiar,
      // podany w pliku konfiguracyjnym
      case 1: {echo 'Rozmiar pliku jest zbyt duży.'; break;} 
	  
      // jest większy niż wartość pola formularza 
      // MAX_FILE_SIZE
      case 2: {echo 'Rozmiar pliku jest zbyt duży.'; break;}
	  
      // plik nie został wysłany w całości
      case 3: {echo 'Plik wysłany tylko częściowo.'; break;}
	  
      // plik nie został wysłany
      case 4: {echo 'Nie wysłano żadnego pliku.'; break;}
	  
      // pozostałe błędy
      default: {echo 'Wystąpił błąd podczas wysyłania.';
        break;}
    }
    echo '</font>';
    return false;
  }
  return true;
}

//================================================================================================//

?>
</div>
<?php
require_once("includes/latest.php");
require_once("includes/random.php");
?>
