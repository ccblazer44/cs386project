<?php
include('config.php')
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
        //Shows a message.If not user is logged, it will welcome the user
        ?><center>
        Welcome to the Blazer messaging service.<?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?><br />
        This is where you can converse with other users.<br /></center>
                    <center><a href="users.php">Click to see other messaging users</a><br /><br /></center>
        <?php
        //Users choices
        if(isset($_SESSION['username']))
        {
        //We count the number of new messages the user has
        $nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from messaging where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
        //The number of new messages is in the variable $nb_new_pm
        $nb_new_pm = $nb_new_pm['nb_new_pm'];
        //We display the links
        ?>

        <a href="messages.php">Inbox  (<?php echo $nb_new_pm; ?> unread)</a><br />
        <a href="connecting.php">Logout</a>
        <?php
        }
        else
        {
        ?>
        Don't have an account?    <a href="register.php">   Register</a>
        <p>
        Already a user?    <a href="connecting.php">   Log In</a>
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