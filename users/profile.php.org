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
		if(isset($_GET['id']))
		{
		        //Checks if the MSGI account even exists.
			$id = intval($_GET['id']);
			
			$dn = mysql_query('select username, email, dateregistered from users where id="'.$id.'"');
			if(mysql_num_rows($dn)>0)
			{
				$dnn = mysql_fetch_array($dn);
				
		?>
		<h2>Profile of user "<?php echo htmlentities($dnn['username']); ?>" :</h2>
		<table style="width:500px;">
			<tr>
		    	<td></td>
		    	<td class="left">
		    	Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
		    	<p>
		        Account created on <?php echo date('Y/m/d',$dnn['dateregistered']); ?></td>
		    </tr>
		</table>
		<?php
		//Everything below sets up; creating a message to any MSGI Agent.
		if(isset($_SESSION['username']))
		{
		?>
		<br /><a href="createmsg.php?recip=<?php echo urlencode($dnn['username']); ?>" class="big">Send message to <?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a>
		<?php
		}
			}
			else
			{
				echo 'This user is not existent.';
			}
		}
		else
		{
			echo 'The user ID is not defined.';
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