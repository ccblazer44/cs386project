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

    <div id="footer">
        <div id="altnav">
            <a href="../index.html">Main Page</a> - <a href="../about.html">About Me</a> - <a href="../contact.html">Contact Us</a> - <a href="../pro7/login.php">Log In</a> - <a href="index.php">Messages</a>
        </div>
        Copyright @ Chris Blazer
    </div>

</div>
</body>
</html>