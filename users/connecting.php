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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
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

        <?php
		//Logs out the user
		if(isset($_SESSION['username']))
		{
			//This will end the session for that agent, until they log back in
			unset($_SESSION['username'], $_SESSION['userid']);
		?>
		Logged Out<br />
		<a href="<?php echo $url_home; ?>">Home</a>
		<?php
		}
		else
		{
			$ousername = '';
			//If the registry has been sent; this checks that
			if(isset($_POST['username'], $_POST['password']))
			{
				//My brother actually helped me with this configuration
		                //I am still a bit confused at the exact functionality of this
				if(get_magic_quotes_gpc())
				{
					$ousername = stripslashes($_POST['username']);
					$username = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], stripslashes($_POST['username'])) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
					$password = stripslashes($_POST['password']);
				}
				else
				{
					$username = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $_POST['username']) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
					$password = $_POST['password'];
				}
				//This acquires the password of the agent, so it may be registered in my database
				$req = mysqli_query($GLOBALS["___mysqli_ston"], 'select password,id from users where username="'.$username.'"');
				$dn = mysqli_fetch_array($req);
				//Confirmation of the two passwords to ensure they match.
				if($dn['password']==$password and mysqli_num_rows($req)>0)
				{
					$form = false;
					//Saves the username and id in the current session
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['userid'] = $dn['id'];
		?>
		Login successful.<br />
		<a href="<?php echo $url_home; ?>">Back to Messages</a>
		<?php
				}
				else
				{

					$form = true;
					$message = 'One of your inputs are incorrect';
				}
			}
			else
			{
				$form = true;
			}
			if($form)
			{
			if(isset($message))
			{
				echo $message;
			}
		?>

		    <form id="registration" action="connecting.php" method="post">
		        Log In:<br />

		            <br><input type="text" name="username" placeholder="Username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
		            <br><input type="password" name="password" placeholder="Password" id="password" /><br />
                <input style="display:none;"/><input style="display:none;"/>
		            <br><input class="sign-up-button" type="submit" value="Log In" />

		    </form>

		<?php
			}
		}
		?>
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
</div>
</body>
</html>
