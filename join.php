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
<<<<<<< Updated upstream
    <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
=======


    <script type="text/javascript">

    var url = 'https://cefns.nau.edu/~jk788/chitchat/api/api.php';
    var lat;
    var lon;
    var first = true;

    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(updatePosition);
    }

    function updatePosition(position) {
        console.log("Hello World");
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        if (first) {
            first = false;
            getRooms();
        }
    }

    function getRooms() {
        var x = $.ajax({
            url: this.url,
            dataType: 'json',
            cache: false,
            type: 'GET',
            complete: function(){
              console.log(this.url);
            },
            data: {
                'reason': 'get_rooms',
                'lat': this.lat,
                'lon': this.lon
            },
            success: function(data) {
                console.log(data);
                drawComments(data);
            },
            error: function(xhr, status, err) {
                console.error(this.url, status, err.toString());
            }
        });
        console.log(x);
    }


    function drawComments(data) {
        var rooms = data['rooms'];
        if (!rooms.length) {
            return;
        }


        var ul = document.getElementById('room-list');
        var li, link;
        for (var i = 0; i < rooms.length; i++){
            var link = document.createElement("a");
            link.setAttribute("href", "./room.php?id=" + rooms[i].id);
            link.className = "room-title";
            li = document.createElement('li');
            li.className = "room-title";
            link.appendChild(document.createTextNode(rooms[i].name));
            li.appendChild(link);
            ul.appendChild(li);
        }
    }
    </script>
>>>>>>> Stashed changes
</body>
</html>
