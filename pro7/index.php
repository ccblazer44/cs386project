<?php
	require_once('load.php');
	$logged = $j->checkLogin();
	
	if ( $logged == false ) {
		
		$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$redirect = str_replace('index.php', 'login.php', $url);
		
		
		header("Location: $redirect?msg=login");
		exit;
	} else {
		
		$cookie = $_COOKIE['chriscookies'];
		
		
		$user = $cookie['user'];
		$authID = $cookie['authID'];
		
		
		$table = 'je';
		$sql = "SELECT * FROM $table WHERE user_login = '" . $user . "'";
		$results = $jdb->select($sql);

		
		if (!$results) {
			die('Sorry, that username does not exist!');
		}

		
		$results = mysql_fetch_assoc( $results );
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
			<h3>User Info</h3>
			<p>
			<table>
				<tr>
					<td>Name: </td>
					<td><?php echo $results['user_name']; ?></td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td><?php echo $results['user_login']; ?></td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><?php echo $results['user_email']; ?></td>
				</tr>
				
				<tr>
					<td>Joined The Site: </td>
					<td><?php echo date('l, F jS, Y', $results['user_registered']); ?></td>
				</tr>
			</table>
			<p>
			<p>Thank you for supporting my site.  Click here to <a href="login.php?action=logout">log out.</a></p>
			
			
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


<?php } ?>