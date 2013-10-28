<?php

function add_xml($fid){

$fid = "http://www.swinia.cc/?page=show&amp;fileid=".$fid;

$filename = 'sitemap.xml';

$filepath = fopen($filename, 'rb');
$mapa = fread($filepath, filesize($filename));
$mapa = substr($mapa, 0, -10);
$mapa = $mapa."\r\n".'<url><loc>'.$fid.'</loc><lastmod>'.date('o-m-j').'</lastmod><changefreq>always</changefreq><priority>0.5</priority></url>'."\r\n".'</urlset>';
// zapisanie danych do pliku
//fwrite($filepath, $mapa); 
fclose($filepath);

$filepath1 = fopen($filename, 'w+');
// zapisanie danych do pliku
fwrite($filepath1, $mapa); 
fclose($filepath1);



}


//<urlset><url><loc>http://swinia.cc/remove.php?fid=627a9bb9dd6b3f8e4eef8bd94bee22e0</loc><lastmod>2013-10-28</lastmod><changefreq>always</changefreq><priority>1</priority></url>
?>


