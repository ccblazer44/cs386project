<?php

//Starts the session
session_start();
//Connecticn my database
($GLOBALS["___mysqli_ston"] = mysqli_connect('tund.cefns.nau.edu',  'cb367',  'saga44'));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . 'cb367'));
//The Home MSGI Page
$url_home = 'index.php';
//Makes for an easier way to style my website
$design = 'design';
?>
