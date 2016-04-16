<!DOCTYPE html>
<html>
<head>
  <title>Chitchat</title>
	<link rel="stylesheet" href="./css/style.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="./js/menu.js"></script>
	<link rel="stylesheet" href="./js/leaflet.css" />
	<script src="./js/leaflet.js"></script>
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
          <ul id="room-list">
            <li class="room">
              <span class="room-name">Room Title</span>
            </li>
          </ul>
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
    <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
</body>
</html>
