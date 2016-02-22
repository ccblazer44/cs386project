<?php
	require_once('load.php');
	$j->register('login.php');
        //register is the function from my load.php
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
                    
			<h3>Register User Account</h3>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" /></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email" /></td>
					</tr>
					<input type="hidden" name="date" value="<?php echo time(); ?>" />
					<tr>
						<td></td>
						<td><input type="submit" value="Register" /></td>
					</tr>
				</table>
			</form>
			<p>Already a user? <a href="login.php">Log in</a></p>
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