<?php

//header('Content-type: image/jpg');

require_once("classes/db/db.php");

function showcat($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getimg($filename);
$plik = fopen($imgid, 'rb');
$obrazek = fread($plik, filesize($imgid));
fclose($plik);

$doret =  '<img src="data:image/jpg;base64,'.base64_encode($obrazek).'" width="600" />';

return $doret;

}

function showcatlower($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getimg($filename);
$plik = fopen($imgid, 'rb');
$obrazek = fread($plik, filesize($imgid));
fclose($plik);

$doret =  '<img src="data:image/jpg;base64,'.base64_encode($obrazek).'" width="300" />';

return $doret;

}

function showcatthumb($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getimg($filename);
$imgid = $imgid.'thumb';
$plik = fopen($imgid, 'rb');
$obrazek = fread($plik, filesize($imgid));
fclose($plik);

$doret =  '<img src="data:image/jpg;base64,'.base64_encode($obrazek).'" height="80" />';

return $doret;

}

function showcatmain($filename){
	
$baza = new DBconn;
$baza->connect();

//$filename = $_GET['imgid'];

$imgid = $baza->getimg($filename);
$imgid = $imgid.'main';
$plik = @fopen($imgid, 'rb');
$obrazek = @fread($plik, filesize($imgid));
@fclose($plik);

$doret =  '<img src="data:image/jpg;base64,'.base64_encode($obrazek).'"  />';

return $doret;

}

function showcatdesc($filename){

$baza = new DBconn;
$baza->connect();

$imgid = $baza->getrecord($filename);

return $imgid;
}

function showcatmeta($filename){

$baza = new DBconn;
$baza->connect();

$imgid = $baza->getimgmeta($filename);

return $imgid;
}


?>



