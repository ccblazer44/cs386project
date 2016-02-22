<?php
include('config.php');
?>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="../master.css">
    </head>


<body>
<div id="page-container">

    <div id="main-nav">
        <a href="../index.html">MAIN PAGE</a> -- <a href="../about.html">ABOUT ME</a></li> -- <a href="../contact.html">CONTACT US</a> -- <a href="../pro7/login.php">LOG IN</a> -- <a href="index.php">MESSAGES</a>
    </div>

    <div id="header">
        <h1><img src="../images/name.png"
                width="236" height="36" alt="Chris Blazer" border="0" /></h1>
    </div>


    <div id="content">

        <?php
		//Logs out the user
		if(isset($_SESSION['username']))
		{
			//This will end the session for that agent, until they log back in
			unset($_SESSION['username'], $_SESSION['userid']);
		?>
		Logged Out<br />
		<a href="<?php echo $url_home; ?>">Home</a></div>
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
					$username = mysql_real_escape_string(stripslashes($_POST['username']));
					$password = stripslashes($_POST['password']);
				}
				else
				{
					$username = mysql_real_escape_string($_POST['username']);
					$password = $_POST['password'];
				}
				//This acquires the password of the agent, so it may be registered in my database
				$req = mysql_query('select password,id from users where username="'.$username.'"');
				$dn = mysql_fetch_array($req);
				//Confirmation of the two passwords to ensure they match.
				if($dn['password']==$password and mysql_num_rows($req)>0)
				{
					$form = false;
					//Saves the username and id in the current session
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['userid'] = $dn['id'];
		?>
		Login successful.<br />
		<a href="<?php echo $url_home; ?>">Back to Messages</a></div>
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
		
		    <form action="connecting.php" method="post">
		        LOG IN:<br />
		        
		            <br> <label for="username">Username    </label><input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
		            <br><label for="password">Password    </label><input type="password" name="password" id="password" /><br />
		            <br><input type="submit" value="Log In" />
				
		    </form>
		
		<?php
			}
		}
		?>
            
            
        </div>

    </div>

    <div id="footer">
        <div id="altnav">
            <a href="../index.html">Main Page</a> - <a href="../about.html">About Me</a> - <a href="../contact.html">Contact Us</a> - <a href="../pro7/login.php">Log In</a> - <a href="index.php">Messages</a>
        </div>
        Copyright @ Chris Blazer
    </div>

</div>
</body>
</html>