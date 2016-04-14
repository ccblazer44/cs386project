<?php
include('config.php');

if (!isset($_GET['id'])) {
  header("Location: join.php");
}

$room_id = $_GET['id'];

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
 	<link rel="stylesheet" href="../js/leaflet.css" />
 	<script src="../js/leaflet.js"></script>
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 </head>


 <body>

   <div id="main-nav">

 		<div id="brand-logo">
 			<a href="../index.html"><img src="../img/logo-white.png" /></a>
 		</div>
 		<ul>
       <?php
       include('nav.php');
       ?>
 		</ul>
 		<a class="toggle-nav" href="#">&#9776;</a>
 	</div>

  <div id="landing" class="container-full">
    <div id="chatbox">
      <div id="chat">
        <ul id="chat-view">
          <?php
          $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT user, message FROM MESSAGES");


          while ($row = mysqli_fetch_assoc($req)) {
            ?>
            <li class="chat-message">
              <span class="author"><?php echo $row['user'];?>:</span> <?php echo $row["message"]; ?>
            </li>
            <?php
          }
          ?>
        </ul>
      </div>
      <div id="chatform">
        <form class="chatform" action="#" method="post">
          <textarea id="chat-input" name="message" ></textarea>
          <input id="chat-submit" type="submit">
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

  <script type="text/javascript">

  var queryDict = {};
  location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});


  $("#chat-input").keypress(function(e) {
    if(e.which == 13) {
      $(this).val("");
      e.preventDefault();
    }
  });

  if (navigator.geolocation) {
      navigator.geolocation.watchPosition(updatePosition);
  }

  var url = 'https://cefns.nau.edu/~jk788/chitchat/users/api/api.php';
  var lat;
  var lon;
  var id = parseInt(queryDict['id']);
  var last = 0;
  var interval;

  function updatePosition(position) {
      lat = position.coords.latitude;
      lon = position.coords.longitude;
  }

  function fetch() {
      $.ajax({
          url: this.url,
          dataType: 'json',
          cache: false,
          type: 'GET',
          data: {
              'reason': 'get_messages',
              'id': this.id,
              'lat': this.lat,
              'lon': this.lon,
              'last': this.last
          },
          success: function(data) {
              drawComments(data);
              interval = setTimeout(fetch, 1000);
          },
          error: function(xhr, status, err) {
              console.error(this.url, status, err.toString());
          }
      });
  }

  function drawComments(data) {
      var messages = data['messages'];
      if (!messages.length) {
          return;
      }

      var ul = document.getElementById('chat-view');
      var li, span;
      for (var i = 0; i < messages.length; i++){
          li = document.createElement('li');
          li.className = "chat-message";
          span = document.createElement('span');
          span.className = "author";
          span.appendChild(document.createTextNode(messages[i].user + ": "));
          li.appendChild(span);
          li.appendChild(document.createTextNode(messages[i].message))
          ul.appendChild(li);
          last = messages[i].id;
      }
  }

  var timeout = setTimeout(fetch, 1000);
  </script>

  <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
 </body>
</html>
