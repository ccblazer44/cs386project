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
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script>
  jQuery(document).ready(function() {
    jQuery('.toggle-nav').click(function(e) {
        jQuery(this).toggleClass('active');
        jQuery('#main-nav ul').toggleClass('active');
        e.preventDefault();
    });
  });
  </script>
</head>


<body>

  <div id="main-nav">

		<div id="brand-logo">
			<a href="../index.html"><img src="../assets/logo-white.png" /></a>
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
		//Submission check
		if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email']) and $_POST['username']!='')
		{
			//Configuration with the help of my brother
			if(get_magic_quotes_gpc())
			{
				$_POST['username'] = stripslashes($_POST['username']);
				$_POST['password'] = stripslashes($_POST['password']);
				$_POST['passverif'] = stripslashes($_POST['passverif']);
				$_POST['email'] = stripslashes($_POST['email']);

			}
			//Confirmation that the two passwords match
			if($_POST['password']==$_POST['passverif'])
			{
				//Make sure that the password is atleast 3 or greater
				if(strlen($_POST['password'])>=3)
				{
					//Validation for the email
					if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
					{
						//We protect the variables
						$username = mysql_real_escape_string($_POST['username']);
						$password = mysql_real_escape_string($_POST['password']);
						$email = mysql_real_escape_string($_POST['email']);

						//Confirmation that there are no duplicate agent names
						$dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
						if($dn==0)
						{
							//I did not auto-increment the ID for preference.
		                                        //Therefore, this just counts it from the previous once made
							$dn2 = mysql_num_rows(mysql_query('select id from users'));
							$id = $dn2+1;
							//Database collects and saves all inputs
							if(mysql_query('insert into users(id, username, password, email, dateregistered) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'", "'.time().'")'))
							{
								$form = false;
		?>
		Success!  Now log in.<br />
		<a href="connecting.php">Log in</a>
		<?php
							}
							else
							{
								$form = true;
								$message = 'ERRORS';
							}
						}
						else
						{
							//usernames not available
							$form = true;
							$message = 'That username has already been taken';
						}
					}
					else
					{
						//Invalid email
						$form = true;
						$message = 'Invalid email';
					}
				}
				else
				{
					//Password does not meet the requirements
					$form = true;
					$message = 'Your password must be greater than 3 characters';
				}
			}
			else
			{
				//Validation of matching passwords
				$form = true;
				$message = 'Please confirm your passwords match';
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
		    <form action="register.php" method="post">
		        Create an Account<br />
		            <br><label for="username">Username  </label><input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
		            <br><label for="password">Password (3 char. min.)  </label><input type="password" name="password" /><br />
		            <br><label for="passverif">Confirm Password  </label><input type="password" name="passverif" /><br />
		            <br><label for="email">Email  </label><input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />

		            <br><input type="submit" value="Create" />
		    </form>
		<?php
		}
		?>


        </div>
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
