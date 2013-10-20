<?php

/**
* DATABASE CONF HERE:
**/

class DBconn {

//######################################//
//EDYTUJ TYLKO TUTAJ:

private $hostname = "localhost";
private $dbname = "kotkiDB";
private $username= "root";
private $password = "bitchfrom666";

//TUTAJ PRZESTAN
//######################################//

public $dbh = null;

//=========================================================================//

public function connect(){

$db_host = $this->hostname;
$db_name = $this->dbname;
$db_user = $this->username;
$db_pass = $this->password;

/**
*użyj tego jesli chcesz podac adres socketa:

try { 
    $dbh=new PDO("mysql:unix_socket=/var/run/mysqld/mysqld.sock;host=$db_host;dbname='$db_name", $db_user, $db_pass);
	echo "mysql:host=$this->hostname;dbname=$this->dbname";

} 
*
**/

try { 
    $this->dbh=new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
	//echo "mysql:host=$this->hostname;dbname=$this->dbname";	
	
} 
catch(PDOException $e) { 
    echo $e->getMessage(); 
} 




}
//==========================================================================//

public function addcat($name, $desc, $path, $fileid, $user, $added, $pass, $rate, $fault, $visible, $code){


$stmt = $this->dbh->exec("
INSERT INTO `kotkiDB`.`catz` (
`name` ,
`description` ,
`path` ,
`fileid` ,
`user` ,
`added`,
`rempass`,
`rate`,
`fault`,
`visible`,
`code`
)
VALUES (
'$name' , '$desc', '$path', '$fileid', '$user', '$added', '$pass', '$rate', '$fault', '$visible', '$code'
);
");
//echo $stmt['description'];

if (!$stmt)
	echo "Failed to prepare statement: (". print_r($this->dbh->errorInfo()).")\n";
/*
  foreach($stmt as $row)
      {
          echo '<li>'.$row['description'].'</li>';
      }*/



}

//============================================================================//

public function addcatmeta($fileid, $locale, $age){


$stmt = $this->dbh->exec("
INSERT INTO `kotkiDB`.`catzmeta` (
`fileid` ,
`locale` ,
`age` 
)
VALUES (
'$fileid' , '$locale', '$age'
);
");
//echo $stmt['description'];

if (!$stmt)
	echo "Failed to prepare statement: (". print_r($this->dbh->errorInfo()).")\n";
/*
  foreach($stmt as $row)
      {
          echo '<li>'.$row['description'].'</li>';
      }*/



}

//============================================================================//

public function addmessage($topic, $mail, $text, $added){


$stmt = $this->dbh->exec("
INSERT INTO `kotkiDB`.`catzmessages` (
`topic` ,
`mail` ,
`text`,
`added` 
)
VALUES (
'$topic' , '$mail', '$text', '$added'
);
");
//echo $stmt['description'];

if (!$stmt)
	echo "Failed to prepare statement: (". print_r($this->dbh->errorInfo()).")\n";
/*
  foreach($stmt as $row)
      {
          echo '<li>'.$row['description'].'</li>';
      }*/



}

//============================================================================//


public function adduser($name, $password, $email, $ip, $registertime){

$stmt = $this->dbh->exec("
INSERT INTO `kotkiDB`.`catzusers` (
`name` ,
`password` ,
`email` ,
`ip` ,
`registertime`
)
VALUES (
'$name' , '$password', '$email', '$ip', '$registertime'
);
");
//echo $stmt['description'];

if (!$stmt)
	echo "Failed to prepare statement: (". print_r($this->dbh->errorInfo()).")\n";

}

//=============================================================================//

public function addcomment($fileid, $text){

$author = "Anonymous";
$added = time();
$visible = 1;
$points = 0;

$stmt = $this->dbh->exec("
INSERT INTO `kotkiDB`.`catzcomments` (
`fileid` ,
`text` ,
`author` ,
`added` ,
`visible`,
`points`
)
VALUES (
'$fileid' , '$text', '$author', '$added', '$visible', '$points'
);
");
//echo $stmt['description'];

if (!$stmt)
	echo "Failed to prepare statement: (". print_r($this->dbh->errorInfo()).")\n";

}



//=============================================================================//

public function isuser($ausername, $apassword){
$loggedcond = 0;

/**
$sql="SELECT count(*) FROM [tablename] WHERE key == ? ";
$sth = $this->db->prepare($sql);
$sth->execute(array($key));
$rows = $sth->fetch(PDO::FETCH_NUM);
echo $rows[0];
**/

$count = $this->dbh->query("SELECT COUNT(*) FROM `kotkiDB`.`catzusers` WHERE `name` = '$ausername' AND `password` = '$apassword'");
$row = $count->fetch(PDO::FETCH_NUM);
echo $row[0];

$loggedcond = $row[0];

return $loggedcond;

}

//===============================================================================//

public function getlatest(){

$count = $this->dbh->query("SELECT * FROM `kotkiDB`.`catz` WHERE `visible` = '1' ORDER BY `id` DESC LIMIT 1");
$row = $count->fetch();

return $row["fileid"];

}

//===============================================================================//

public function getcomments($fileid){

$count = $this->dbh->query("SELECT * FROM `kotkiDB`.`catzcomments` WHERE `fileid` = '$fileid' AND `visible` = '1'");
return $count;

}

//===============================================================================//

public function getimg($fid){

$count = $this->dbh->query("SELECT `path` FROM `kotkiDB`.`catz` WHERE `fileid` = '$fid' AND `visible` = '1'");
$row = $count->fetch();

return $row["path"];

}

//===============================================================================//

public function getimgmeta($fid){

$count = $this->dbh->query("SELECT * FROM `kotkiDB`.`catzmeta` WHERE `fileid` = '$fid'");
$row = $count->fetch();

return $row;

}

//===============================================================================//

public function getimgs($fid, $order){

$count = $this->dbh->query("SELECT * FROM `kotkiDB`.`catz` WHERE `visible` = '1' ORDER BY $order DESC LIMIT $fid");
return $count; 

}

//===============================================================================//

public function getrecord($fid){

$count = $this->dbh->query("SELECT * FROM `kotkiDB`.`catz` WHERE `fileid` = '$fid' AND `visible` = '1'");
$row = $count->fetch();

return $row;

}

//===============================================================================//

public function getimgrate($fid){

$count = $this->dbh->query("SELECT `rate` FROM `kotkiDB`.`catz` WHERE `fileid` = '$fid'");
$row = $count->fetch();

return $row["rate"];

}

//===============================================================================//

public function setimgrate($fid, $note){

$ratecount = $this->getimgrate($fid);


if ($note == "git"){
$rate = $ratecount + 1;
}

if ($note == "shit"){
$rate = $ratecount - 1;
}
$count = $this->dbh->exec("UPDATE `kotkiDB`.`catz` SET `rate` = '$rate' WHERE `fileid` = '$fid'");

}

//================================================================================//

public function getimgcode($fid){

$count = $this->dbh->query("SELECT `code` FROM `kotkiDB`.`catz` WHERE `fileid` = '$fid'");
$row = $count->fetch();

return $row["code"];

}

//===============================================================================//

public function setimgcode($fid, $code){

$count = $this->dbh->exec("UPDATE `kotkiDB`.`catz` SET `code` = '$code' WHERE `fileid` = '$fid'");

}

//================================================================================//

public function setimgvisibility($fid, $value){

$count = $this->dbh->exec("UPDATE `kotkiDB`.`catz` SET `visible` = '$value' WHERE `fileid` = '$fid'");

}

//================================================================================//


}//end of DBconn class

?>
