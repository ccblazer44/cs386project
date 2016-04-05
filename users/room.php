<?php
include('config.php');

if (!isset($_GET['id'])) {
  header("Location: search.php");
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
          $req = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT user, message FROM s_chat_messages");


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

  $("#chat-input").keypress(function(e) {
    if(e.which == 13) {
      $(this).val("");
      e.preventDefault();
    }
  });
  </script>

  <script src="http://localhost:35729/livereload.js" charset="utf-8"></script>
 </body>
</html>
