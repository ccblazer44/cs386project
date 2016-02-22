<?php
	require_once('load.php');
	if ( isset($_GET['action']) == 'logout' ) {
         
		$loggedout = $j->logout();
	}
	
	$logged = $j->login('index.php');
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../master.css">
</head>

<body>
<div id="page-container">

	<div id="main-nav">
		<a href="../index.html">MAIN PAGE</a> -- <a href="../about.html">ABOUT ME</a></li> -- <a href="../contact.html">CONTACT US</a> -- <a href="login.php">LOG IN</a> -- <a href="../pro8/index.php">MESSAGES</a>
	</div>

	<div id="header">
		<h1><img src="../images/name.png"
				width="236" height="36" alt="Chris Blazer" border="0" /></h1>
	</div>

	<div id="sidebar-a">

 	   Yay a sidebar!

	</div>

	<div id="content">

		<div style="width: 400px; border: 2px solid black; border-radius:25px; padding: 10px; margin: 20px auto;">
			<?php if ( $logged == 'invalid' ) : ?>
				<p style="background: red; border: 1px solid #c05555; padding: 7px 10px;">
                                    <font color="white">Credentials not recognized.  Please try again.</font>
				</p>
			<?php endif; ?>
			<?php if ( isset($_GET['reg']) == 'true' ) : ?>
				<p style="background: green; border: 1px solid #eedc82; padding: 7px 10px;">
                                    <font color="white">You have created an account.  You can now log in.</font>
				</p>
			<?php endif; ?>
			<?php if ( isset($_GET['action']) == 'logout' ) : ?>
				<?php if ( $loggedout == true ) : ?>
					<p style="background: green; border: 1px solid #eedc82; padding: 7px 10px;">
						<font color="white">Logout successful.</font>
					</p>
				<?php else: ?>
					<p style="background: red; border: 1px solid #c05555; padding: 7px 10px;">
						<font color="white">ERROR</font>
					</p>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( isset($_GET['msg']) == 'login' ) : ?>
				<p style="background: red; border: 1px solid #c05555; padding: 7px 10px;">
                                    <font color="white">Please make an account.</font>
					</p>
			<?php endif; ?>
		
			<h3>Log In</h3>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Log In!" /></td>
					</tr>
				</table>
			</form>
			<p>Not a user? <a href="register.php">Make and account.</a></p>
		</div>

	</div>

	<div id="footer">
		<div id="altnav">
			<a href="../index.html">Main Page</a> - <a href="../about.html">About Me</a> - <a href="../contact.html">Contact Us</a> - <a href="login.php">Log In</a> - <a href="../pro8/index.php">Messages</a>
		</div>
		Copyright @ Chris Blazer
	</div>

</div>
</body>
</html>





		

