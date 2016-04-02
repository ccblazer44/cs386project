<?php
session_start();

($GLOBALS["___mysqli_ston"] = mysqli_connect('tund.cefns.nau.edu',  'cb367',  'saga44'));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE " . 'cb367'));

$url_home = 'index.php';

$design = 'design';
?>
