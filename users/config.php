<?php


$mysql_server = "tund.cefns.nau.edu";
$mysql_user = "cb367";
$mysql_password = "saga44";
$mysql_db = "cb367";
$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
if ($mysqli->connect_errno) {
  printf("Connection failed: %s \n", $mysqli->connect_error);
  exit();
}

$mysqli->set_charset("utf8");

  session_start();
//The Home MSGI Page
$url_home = 'index.php';

//Makes for an easier way to style my website
$design = 'design';
?>
