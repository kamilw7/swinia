<?php
// funkcja obcinania tekstu
// $string - ciag znakow
// $end - ilosc wyswietlonych liter

function cS($string,$end) {

if(strlen($string)>$end){
//$string=preg_replace('/s+?(S+)?$/','',substr($string,0,$end+1));
$string=mb_substr($string,0,$end, 'utf-8')."...";
}
return $string;
}
//$tekst = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mollis laoreet lorem. Vestibulum elementum nibh et sem euismod tincidunt. Nullam fermentum est id augue. Vestibulum aliquet, nunc vitae dignissim ornare, felis orci feugiat elit, varius sagittis libero nibh vel massa. Vivamus sed odio.';
//
//$obciety = cutString($tekst,'15');
//echo $obciety;
?>
