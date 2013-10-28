<?php
session_start();
?>

<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" lang="en-US"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en-US"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en-US"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en-US"> <!--<![endif]-->
<head>

<meta charset="UTF-8" />
<meta name="Keywords" content="Swinia, świnia, świnia.cc, podkładanie świnii, świnie" />
<meta name="Description" content="www.swinia.cc - Podłóż komuś świnię!" />

<?php 
if (isset ($_GET['fileid'])){

require_once('classes/db/db.php');
require_once('includes/show.php');
$baza = new DBconn;
$baza->connect();

$latest = $_GET['fileid'];
$description = showcatdesc($latest);
$meta = showcatmeta($latest);

if ($meta["age"] == "0"){
$meta["age"] = " ";
}
else {
$meta["age"] = $meta["age"].', ';
}

if ($meta["locale"] == "all"){
$meta["locale"] = "Polska - ";
}
else {
$meta["locale"] = $meta["locale"].' - ';
}

echo '<title>'.$description["name"].', '.$meta["age"].$meta["locale"];
}
else {
echo '<title>';
}
?>
Swinia.cc - podloz komus swinie!</title>

<link rel="stylesheet" type="text/css" href="content/style.css" />

<!-- FB -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pl_PL/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- End FB code -->



<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.nl.pilestro.pw//";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();

</script>

<!-- End Piwik Code -->
</head>

<body  onload="document.getElementById('captcha-form').focus()" >
<noscript><p><img src="http://piwik.nl.pilestro.pw/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
<div style="float: left; position: fixed; z-index: 0; margin-top: 200px;">
<a href="http://www.stargames.com/bridge.asp?idr=49155&lang=pl" target="_blank"/><img src="content/images/ad1.gif"/></a>
</div>

<div style="float: right; position: fixed; z-index: 0; margin-top: 200px; margin-left: 1200px">
<a href="http://www.stargames.com/bridge.asp?idr=49155&lang=pl" target="_blank"/><img src="content/images/ad2.gif"/></a>
</div>

<div id="background">

<div id="center">

<?php
require_once('includes/toolbar.php');
?>



<div id="top1">

<div id="top">

<div style="height: 60px; width: 10%; float: left; ">
<a href="./"><img src="content/images/top/top1.png" height="82" /></a>
</div>
<div style="height: 65px; margin-left: 530px">
<!-- START CLIENT.YESADVERTISING CODE -->
<script language="javascript" type="text/javascript" charset="utf-8">
var cpxcenter_banner_border = 'rgba(100,100,100,0.1)';
var cpxcenter_banner_text = '#3d3d3d';
var cpxcenter_banner_bg = 'rgba(100,100,100,0.1)';
var cpxcenter_banner_link = 'rgba(100,100,100,0.1)';
cpxcenter_width = 468;
cpxcenter_height = 60;
</script>
<script language="JavaScript" type="text/javascript" src="//ads.cpxcenter.com/cpxcenter/showAd.php?nid=4&amp;zone=35165&amp;type=banner&amp;sid=26848&amp;pid=26563&amp;subid=">
</script>
</div>
<!-- END CLIENT.YESADVERTISING CODE -->

</div>
</div>



