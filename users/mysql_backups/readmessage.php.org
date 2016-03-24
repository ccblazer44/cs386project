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
		//Is the user logged in? That is what that is doing below.
		if(isset($_SESSION['username']))
		{
		if(isset($_GET['id']))
		{
		$id = intval($_GET['id']);
		$req1 = mysql_query('select title, user1, user2 from messaging where id="'.$id.'" and id2="1"');
		$dn1 = mysql_fetch_array($req1);
		//Checks if the conversation is existent
		if(mysql_num_rows($req1)==1)
		{
		//Does the agent have permission to look at the conversation.
		if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
		{
		if($dn1['user1']==$_SESSION['userid'])
		{
			mysql_query('update messaging set user1read="yes" where id="'.$id.'" and id2="1"');
			$user_partic = 2;
		}
		else
		{
			mysql_query('update messaging set user2read="yes" where id="'.$id.'" and id2="1"');
			$user_partic = 1;
		}
		//MSGI Inquiry List
		$req2 = mysql_query('select messaging.timestamp, messaging.message, users.id as userid, users.username from messaging, users where messaging.id="'.$id.'" and users.id=messaging.user1 order by messaging.id2');
		if(isset($_POST['message']) and $_POST['message']!='')
		{
			$message = $_POST['message'];
			//My brother said this is the configuration
		        //To be honest, I'm quite confused at this part.
			if(get_magic_quotes_gpc())
			{
				$message = stripslashes($message);
			}
			$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
			//Sends the MSGI message to the database and marks it unread unto the website.
			if(mysql_query('insert into messaging (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update messaging set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
			{
		?>
		Sent<br />
		<a href="readmessage.php?id=<?php echo $id; ?>">View Conversation</a>
		<?php
			}
			else
			{
		?>
		ERROR<br />
		<a href="readmessage.php?id=<?php echo $id; ?>">View Conversation</a>
		<?php
			}
		}
		else
		{
		//We display the messages
		?>
		
		<h2>Subject: <?php echo $dn1['title']; ?></h2>

		<table>
			<tr>
		    	<th>From</th>
		        <th>Message</th>
		    </tr>
		<?php
		while($dn2 = mysql_fetch_array($req2))
		{
		?>
			<tr>
		    	<td><?php
		{
		}
		?>
			<br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
		    	<td><font size="2">Sent: <?php echo date('m/d/Y' ,$dn2['timestamp']); ?>: </font>
		    	<font size="3"><?php echo $dn2['message']; ?></font></td>
		    </tr>
		<?php
		}
		//Reply 
		?>
		</table><br />
		<h2>Reply</h2>
		
		    <form action="readmessage.php?id=<?php echo $id; ?>" method="post">
		    	<label for="message">Message</label><br />
		        <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
		        <input type="submit" value="Send" />
		       
		<?php
								echo"<form name='theform' method='post' action='DeleteMessages.php'>";
								echo"<input type='hidden' name='UserID' value='$UserID'>";
								echo"<input type='hidden' name='OtherUserID' value='$OtherUserID'>";
								echo"<button type='submit'>Delete Your Messages</button></div>";
								echo"</form>";
							?>


		    </form>

		</div>
		<?php
		}
		}
		else
		{
			echo 'Cannot access';
		}
		}
		else
		{
			echo 'This conversation is not existent';
		}
		}
		else
		{
			echo 'Not found.';
		}
		}
		else
		{
			echo 'You are not logged in; to see this.';
		}
		?>
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