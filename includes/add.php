<?php
require_once("includes/popular.php");
?>

<div id="add">
<?php
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


if (!isset($_FILES['nazwa_pliku'])){

?>

<p align="center"><b>Dodaj nową świnię</b></p>
<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="5120000000" />
<table align="center">
<tr>
<td>
Nazwa świnii: </td><td> <input type="text" maxlength="12" name="kitten_name" style="width: 400px;" /> </td>
</tr>
<tr>
<td>
Podpis na obrazek: </td><td> <input type="text" maxlength="20" name="kitten_subtitle" style="width: 400px;" /> </td>
</tr>
<td>
Opis świnii: </td><td>  <textarea name="kitten_desc" maxlength="200" type="text" id="kitten_desc" cols="70" style="height: 100px; width: 400px;"></textarea></td>
</tr>
</tr>
<td>
Portret świnii:
</td>
<td>
<input type="file" name="nazwa_pliku" style="width: 400px;" /></td>
</tr>
<tr>
<td>
Hasło usunięcia: </td><td> <input type="text" maxlength="12" name="kitten_password" style="width: 400px;" /> </td>
</tr>
<tr>
<td>
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
<td>
Przepisz kod świnii:
</td>
<td>
<input type="text" name="captcha" id="captcha-form" autocomplete="off" style="width: 400px;" /><br/>
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

}
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


$blad = $_FILES['nazwa_pliku']['error'];
sprawdz_bledy($blad);
$typ = $_FILES['nazwa_pliku']['type'];
$typcond = sprawdz_typ($typ);

$name = $_POST["kitten_name"];
$subtitle = $_POST["kitten_subtitle"];
$desc = $_POST["kitten_desc"];
$pass = $_POST["kitten_password"];

if ($typcond == 1){
$imgpath = zapisz_plik();
$imgpath = plik_as_poster($imgpath, $name, $subtitle);

}



$path = $imgpath;

echo "Nazwa świni:";
echo $_POST["kitten_name"];
echo "<br />";
echo "<br />";
echo "Podpis obrazka:";
echo $_POST["kitten_subtitle"];
echo "<br />";
echo "<br />";
echo "Opis świnii:";
echo $_POST["kitten_desc"];
echo "<br />";
echo "<br />";
echo "Twoje hasło usunięcia:<b>";
echo $_POST["kitten_password"];
echo "<br />";
echo "<br />";
echo "</b>Zdjęcie świnii:";
echo '<br/ ><img src="'.$imgpath.'" />';


add_to_db($name, $desc, $path, $pass);

}//fi captcha_cond
else {
echo '<a href="?page=add">Niepoprawny captcha. Wypełnij formularz ponownie</a>';
}


}

} else { echo '<a href="?page=login&redirect=add">Zaloguj sie!</a>'; }
//===============================================================================================//



function add_to_db($name, $desc, $path, $pass){
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
	$baza->addcat($name, $desc, $path, $fileid, $user, $added, $pass);


}
//===============================================================================================//

function plik_as_poster($filename, $title, $subtitle){

	$znakwodny = "content/images/watermark.png";
	$source = $filename;
	$dest = $filename;
    	$dirpath = dirname($filename);

	echo $dirpath;
	
	exec('convert -geometry 500x '.$source.' '.$source);

	$command = 'composite -dissolve 50% -gravity southeast -quality 100 ' . $znakwodny . ' ' . $source . ' ' . $source;
	shell_exec($command);
       
	exec('convert '.$source.'  -bordercolor \'#ff309a\' -border 3x3 '.$source); // add small black border
        exec('convert '.$source.'  -bordercolor white -border 2x2 '.$source); // add white line around the image
        exec('convert '.$source.'  -bordercolor \'#ff309a\' -border 10%x10% '.$source); //add a wide black border around

        exec('convert '.$source.' -size 15x15 xc: \'#ff309a\' -background \'#ff309a\' -append  -pointsize 64 -fill white -draw "gravity South text 0,0 \'' .$title. '\'" '.$source);
	exec('convert '.$source.'  -bordercolor \'#ff309a\' -border 0%x5% text2.ppm'); //add a wide black border around
        exec('convert '.$source.' -size 15x15 xc:\'#ff309a\' -background \'#ff309a\' -append  -pointsize 32 -fill white -draw "gravity South text 0,0 \'' .$subtitle. '\'" '.$source);
   
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
	
  if(is_uploaded_file($_FILES['nazwa_pliku']['tmp_name']))
  {
    if(!move_uploaded_file($_FILES['nazwa_pliku']['tmp_name'], $lokalizacja))
    {
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
        return false;  
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
