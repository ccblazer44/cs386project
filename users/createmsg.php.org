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
		//checks for user
		if(isset($_SESSION['username']))
		{
		$form = true;
		$otitle = '';
		$orecip = '';
		$omessage = '';
		//Has it been sent.
		if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
		{
			$otitle = $_POST['title'];
			$orecip = $_POST['recip'];
			$omessage = $_POST['message'];
			//Same functionality as in my readmessage.php
			if(get_magic_quotes_gpc())
			{
				$otitle = stripslashes($otitle);
				$orecip = stripslashes($orecip);
				$omessage = stripslashes($omessage);
			}
			//Validation to ensure if the input fields are correct and filled
			if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
			{
				$title = mysql_real_escape_string($otitle);
				$recip = mysql_real_escape_string($orecip);
				$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
				//Does the person you are sending the message to exist. This is what the below code processes.
				$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from messaging) as npm from users where username="'.$recip.'"'));
				if($dn1['recip']==1)
				{
					//Ensures that the sender is not sending a message to him/her--self
					if($dn1['recipid']!=$_SESSION['userid'])
					{
						$id = $dn1['npm']+1;
						if(mysql_query('insert into messaging (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
						{
		?>
		The message has successfully been sent.<br />
		<a href="messages.php">Back to Inbox</a></div>
		<?php
							$form = false;
						}
						else
						{
							//Otherwise, ERROR!
							$error = 'ERROR!';
						}
					}
					else
					{
						$error = 'You cannot send messages to yourself.';
					}
				}
				else
				{
					$error = 'User not found.';
				}
			}
			else
			{
				$error = 'Missing input.';
			}
		}
		elseif(isset($_GET['recip']))
		{
		        //Gets the user, so he/she can recieve the message.
			$orecip = $_GET['recip'];
		}
		if($form)
		{
		if(isset($error))
		{
			echo $error;
		}
		?>
			<p>
		    <form action="createmsg.php" method="post">
				<b>New Message</b><br />
		                <br> <label for="title">Subject    </label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
		                <br><label for="recip">To (Username)    </label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
		                <br> <label for="message">Message    </label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
		                <br> <input type="submit" value="Send" />
		    </form>
		<?php
		}
		}
		else
		{
			echo 'Please log in.';
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