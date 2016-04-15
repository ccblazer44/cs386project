<?php

if (!isset($_SESSION['username'])) {

?>
<li><a href="../about.html">About</a></li>
<li><a href="../contact.html">Support</a></li>

<?php
} ?>
<li><a href="../explore.html">Explore</a></li>

<?php

if(!isset($_SESSION['username'])) {

  ?>
<li class="register"><a href="register.php">Sign Up</a></li>
<li class="login"><a href="login.php">Login</a></li>
<?php

} else {
?>
<li class="register" ><a href="create.php">Create</a></li>
<li class="login"><a href="join.php">Join</a></li>
<?php
} ?>
