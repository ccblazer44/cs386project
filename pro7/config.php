<?php
//Everything below configures all of my variables that I will be using 
//within my other php files.
//A NONCE and AUTH SALT was made for hashing password for advanced network security
//I found these in a PHP Nonce Library
//The hash password is different for every user that has been created.
//I used password_hash() to generate a salt and store the password.

define('DB_NAME', 'cb367');

define('DB_USER', 'cb367');

define('DB_PASS', 'saga44');

define('SITE_KEY', 'tIVLEabZMrxm!%4ZHJWnXAjxbPt4mYGtyb!@$%&^%VQJsxGjOIdej#OT3EhCpxqC5Bu6KSOJM$$##VJV9jLF5uWiiFXm1G');

define('NONCE_SALT', 'fxmAMC5TiY2_)(eh2DfbOOX4*&F73ldggm8KZP35N48t3OVbTaoOpaOlLydef#_+kvusgNgafnuujTPdazfzqpDy');

define('AUTH_SALT', 'g)(*)Um9SXCqWWvSDm6&^&k3iwMqPghWzTgqMSiy)(&*&RaAoMdbyLNuRdvH(gwL0fA7Umlmy4ZvH04r2xjp7KH2ahNNc');
?>