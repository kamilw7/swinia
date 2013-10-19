<?php
require_once("includes/menu.php");
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
$pass = $_POST["kitten_password"];

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
echo "Twoje hasło usunięcia:<b>";
echo $_POST["kitten_password"];
echo "<br />";
echo "</b>Zdjęcie świnii:";
echo '<br/ ><img src="'.$imgpath.'" />';
echo '<br /><br /><a href="./?page=show&fileid='.md5($path).'">Przejdź do strony zdjęcia</a>';


add_to_db($name, $desc, $fault, $path, $pass);

}//fi captcha_cond
else {
echo '<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
      <input type="hidden" name="form_kitten_name" value="'.$_POST["kitten_name"].'" />
      <input type="hidden" name="form_kitten_subtitle" value="'.$_POST["kitten_subtitle"].'" />
      <input type="hidden" name="form_kitten_fault" value="'.$_POST["kitten_fault"].'" />
      <input type="hidden" name="form_kitten_desc" value="'.$_POST["kitten_desc"].'" />
      <input type="hidden" name="form_kitten_file" value="'.$_POST["kitten_file"].'" />
      <input type="hidden" name="form_kitten_password" value="'.$_POST["kitten_password"].'" />';
echo '<input type="submit" value="Niepoprawny captcha. Wypełnij formularz ponownie" />';
} //esle fi captcha_cond


}// fi isset file[nazwapliku];

else {

?>

<p align="center"><b>Dodaj nową świnię</b></p>
<form enctype="multipart/form-data" action="?page=add" 
		 method="post" >
<input type="hidden" name="MAX_FILE_SIZE" value="5120000000" />
<table align="center">
<tr>
<td align="left">
Imię (i nazwisko) świnii: </td><td> <input type="text" maxlength="30" name="kitten_name" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_name'])) echo $_POST['form_kitten_name']; ?>" /> </td>
</tr>
<tr>
<td align="left">
Podpis na obrazek: </td><td> <input type="text" maxlength="30" name="kitten_subtitle" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_subtitle'])) echo $_POST['form_kitten_subtitle']; ?>" /> </td>
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
Portret świnii:
</td>
<td >
<input type="file" name="nazwa_pliku" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_file'])) echo $_POST['form_kitten_file']; ?>" /></td>
</tr>
<tr>
<td align="left">
Hasło usunięcia: </td><td> <input type="text" maxlength="12" name="kitten_password" style="width: 400px;" value="<?php if (isset($_POST['form_kitten_password'])) echo $_POST['form_kitten_password']; ?>" /> </td>
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

} //else isset file[nazwapliku]

} else { echo '<a href="?page=login&redirect=add">Zaloguj sie!</a>'; } //fi $zmiennaa

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

function plik_as_poster($filename, $title, $subtitle){

	$znakwodny = "content/images/watermark.png";
	$source = $filename;
	$thumb = $filename.'thumb';
	$pageimg = $filename.'main';
    	$dirpath = dirname($filename);

	//echo $dirpath;
	
	exec('convert -geometry 500x '.$source.' '.$source);
	//exec('convert -geometry 100x -crop 100x100+0+0+repage '.$thumb.' '.$thumb);
	exec('convert '.$thumb.' -resize 100x100^ -gravity Center -crop 100x100+0+0 +repage '.$thumb);
	exec('convert '.$pageimg.' -resize 500x500^ -gravity Center -crop 500x500+0+0 +repage '.$pageimg);


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
