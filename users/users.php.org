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
        List of Users:
        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
            </tr>
        <?php
        //We get the IDs, usernames and emails of users
        $req = mysql_query('select id, username, email from users');
        while($dnn = mysql_fetch_array($req))
        {
        ?>
            <tr>
                <td class="center"><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                <td class="center"><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php
        }
        ?>
        </table>
    </div>

    <div id="footer">
        <div id="altnav">
            <a href="../index.html">Main Page</a> - <a href="../about.html">About Me</a> - <a href="../contact.html">Contact Us</a> - <a href="../pro7/login.php">Log In</a> - <a href="index.php">Messages</a>
        </div>
        Copyright @ Chris Blazer
    </div>

</div>
</html>