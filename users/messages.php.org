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
        //Is the agent logged in?
        if(isset($_SESSION['username']))
        {
        //Two queries are created below. One for the unread messages and one for the unread messages.
        $req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from messaging as m1, messaging as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
        $req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from messaging as m1, messaging as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
        ?>
                    <center>Inbox</center><br />
        <a href="createmsg.php">Create New Message</a><br />
        <h3><center>Unread(<?php echo intval(mysql_num_rows($req1)); ?>):</h3></center>
        <table>
            <tr>
                <th>Subject -     </th>
                <th>Replies -     </th>
                <th>User -     </th>
                <th>Date Of Message</th>
            </tr>
        <?php
        //unread
        while($dn1 = mysql_fetch_array($req1))
        {
        ?>
            <tr>
                <td class="center"><a href="readmessage.php?id=<?php echo $dn1['id']; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                <td><?php echo $dn1['reps']-1; ?></td>
                <td><a href="profile.php?id=<?php echo $dn1['userid']; ?>"><?php echo htmlentities($dn1['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                <td><?php echo date('m-d-Y' ,$dn1['timestamp']); ?></td>
            </tr>
        <?php
        }
        if(intval(mysql_num_rows($req1))==0)
        {
        ?>
            <tr>
                <td colspan="4" class="center">No unread messages</td>
            </tr>
        <?php
        }
        ?>
        </table>
        <br />
        <h3><center>Read/Sent(<?php echo intval(mysql_num_rows($req2)); ?>):</h3></center>
        <table>
            <tr>
                <th>Subject -     </th>
                <th>Replies -     </th>
                <th>User -     </th>
                <th>Date Of Message</th>
            </tr>
        <?php
        //read/sent
        while($dn2 = mysql_fetch_array($req2))
        {
        ?>
            <tr>
                <td class="center"><a href="readmessage.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                <td><?php echo $dn2['reps']-1; ?></td>
                <td><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                <td><?php echo date('m-d-Y' ,$dn2['timestamp']); ?></td>
            </tr>
        <?php
        }

        if(intval(mysql_num_rows($req2))==0)
        {
        ?>
            <tr>
                <td colspan="4" class="center">No read/sent messages</td>
            </tr>
        <?php
        }
        ?>
        </table>
        <?php
        }
        else
        {
            echo 'You are not logged in';
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