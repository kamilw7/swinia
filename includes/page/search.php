<?php

require_once("classes/db/db.php");
require_once("classes/cutter/cut.php");
require_once("includes/show.php");


if (isset($_GET["action"])){

if ($_GET["action"] == "main"){
require_once('includes/menu.php');
echo '<div id="add">';
}

if ($_GET["action"] == "show"){

require_once('includes/menu.php');
echo '<div id="add">';

if (isset($_POST['locale'])){

echo '<b><br />';
echo 'Wyniki wyszukiwania dla:<br /><br /></b>';
echo 'Miasto: '.$_POST['locale']. '<br />';
echo 'Wiek: '.$_POST['age'] . '<br />';
echo 'Opis: '.$_POST['fraza'];
echo '<br /><br />';

$baza = new DBconn;
$baza->connect();
$thb = $baza->search($_POST['locale'],$_POST['age'],$_POST['fraza']);

echo '<div id="thumbnails">';

foreach ($thb as $thumb){
echo '<div id="thumb">';
echo '<a href="./?page=show&fileid='.$thumb['fileid'].'">';
echo '<table align="center"><tr><td>';
$img = showcatthumb($thumb['fileid']);
echo $img;
echo '</td></tr><tr><td height="25" valign="middle"><font size="2">';
echo cS($thumb['name'], 13);
echo '</font></td></tr></table>';
echo '</a>';
echo '</div>';
}

echo '</div>';






echo '</div>';
}

}//fi show

}//fi action
else { 
if (isset ($_GET["set"])){
if ($_GET["set"] == "main"){
require_once('includes/menu.php');
echo '<div id="add">';
}
}
?>

<div id="headerbox">
SZUKAJ:
</div>
<div id="search">


<form method="post" action="?page=search&action=show">	

<p>Imię świnki:</p><input type="text" name="fraza" width="200">

<p>Miasto:</p>
<select name="locale">
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
<option value="Wąbrze źno">Wąbrze źno</option>
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

<p>Wiek:</p>
<select name="age" width="200">
<option value="0"> ------ wszystkie ------ </option>
<?php 
for($value = 1; $value <= 100; $value++){ 
    echo('<option value="' . $value . '">' . $value . '</option>');
}


?>
</select>



<br /><br /><br /><input type="submit" value="Szukaj">

</form>
</div>


<?php
}
?>
