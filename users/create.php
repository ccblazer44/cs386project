<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chitchat</title>
	<link rel="stylesheet" href="../css/style.css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
	<script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<body>

  <div id="main-nav">

		<div id="brand-logo">
			<a href="../index.html"><img src="../img/logo-white.png" /></a>
		</div>
		<ul>
			<li><a href="../about.html">About</a></li>
			<li><a href="../contact.html">Support</a></li>
			<li><a href="../explore.html">Explore</a></li>
			<li class="register"><a href="register.php">Sign Up</a></li>
			<li class="login"><a href="connecting.php">Login</a></li>
		</ul>
		<a class="toggle-nav" href="#">&#9776;</a>
	</div>

	<div id="landing" class="container-full">
    <div class="splash-about">
      <div class="splash-about-box">
        <div id="map"></div>
        <form style="margin: 0; padding: 0; text-align:center; max-width: 100%;" class="create-room" action="index.html" method="post">
          <input style="width: 100%;margin-top: 5px;"type="text" name="name" value="" placeholder="Room Name">
          <p style="float: left; width: 10%; line-height: 50px;">Radius</p>
          <input style="float:right; width: 85%; height: 50px;" type="range" min='22.86' max='804.67' step='1' oninput="updateSlider(this.value)"/>
          <input style="margin-top: -5px;" class="sign-up-button" type="submit" value="Create Room" />
        </form>
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
  <script type="text/javascript" charset="UTF-8">
    var marker = null;
    var circle = L.circle([0,0], 390.905);
    var map = L.map('map').setView([0,0], 2);
    map.locate({watch: true, setView: true, maxZoom: 16, enableHighAccuracy: true});
    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
      subdomains: ['a', 'b', 'c']
    }).addTo(map);

    map.on('locationfound', function(e){
      if (marker != null){
        marker.setLatLng(e.latlng);
        circle.setLatLng(e.latlng);
      } else {
        marker = L.marker(e.latlng).addTo(map);
        circle.addTo(map);
      }
    })

    function updateSlider(value) {
      circle.setRadius(value);
    }

  </script>

  <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
</div>
</body>
</html>
