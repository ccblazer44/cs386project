<!DOCTYPE html>
<html>
<head>
	<title>Chitchat</title>
	<link rel="stylesheet" href="./css/style.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="./js/menu.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<div id="main-nav">
		<div id="brand-logo">
			<a href="./index.php"><img src="./img/logo-white.png" /></a>
		</div>
		<ul>
			<?php
			include('nav.php');
			?>
		</ul>
		<a class="toggle-nav" href="#">&#9776;</a>
	</div>

	<div id="landing" class="container-full">
		<div class="splash-about">
			<div class="splash-about-box">
				<center>
				<h1>About Us!</h1>
				<p>Peter Bellagh / Chris Blazer / Jordan Kreps / Matt Nielsen </p>
				<p> CS 386 - Software Engineering Project</p>
			</center>
			</div>
		</div>
	</div>

	<div id="footer">
		<div id="footer-top">
			<ul id="footer-nav">
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li>
				<li><a href="#">Terms of Service</a></li>
				<li><a href="#">Privacy Policy</a></li>
			</ul>
		</div>
		<div id="footer-bottom">
			<p class="text-center"> &copy; Copyright 2016</p>
		</div>
	</div>

</body>
</html>
