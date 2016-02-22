<?php

if(!class_exists('cb367')){
	class cb367 {
		
		function register($redirect) {
			global $jdb;
                            
			$current = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

			$referrer = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


			if ( !empty ( $_POST ) ) {

				
				if ( $referrer == $current ) {
				
					//database class
					require_once('db.php');
						
					//a variable to indicate which table to use within my database
					$table = 'je';
					
					//the tables corresponding names
					$fields = array('user_name', 'user_login', 'user_pass', 'user_email', 'user_registered');
					
					
					$values = $jdb->clean($_POST);
					
					//creates all of my values to correspond with the ones in my table.
					$username = $_POST['name'];
					$userlogin = $_POST['username'];
					$userpass = $_POST['password'];
					$useremail = $_POST['email'];
					$userreg = $_POST['date'];
					
					//timestamp
					$nonce = md5('registration-' . $userlogin . $userreg . NONCE_SALT);
					
					
					$userpass = $jdb->hash_password($userpass, $nonce);
					
					//inserting into my database
					$values = array(
								'name' => $username,
								'username' => $userlogin,
								'password' => $userpass,
								'email' => $useremail,
								'date' => $userreg
							);
					
					
					$insert = $jdb->insert($link, $table, $fields, $values);
					
					if ( $insert == TRUE ) {
						$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
						$aredirect = str_replace('register.php', $redirect, $url);
						
						header("Location: $redirect?reg=true");
						exit;
					}
				} else {
					die('Your application is invalid, you may not be a spy');
				}
			}
		}
		
		function login($redirect) {
			global $jdb;
		
			if ( !empty ( $_POST ) ) {
				
				//form data
				$values = $jdb->clean($_POST);

                                $subname = $values['username'];
				$subpass = $values['password'];

				$table = 'je';

				
				$sql = "SELECT * FROM $table WHERE user_login = '" . $subname . "'";
				$results = $jdb->select($sql);

				//checks if the username is taken no non-existent
				if (!$results) {
					die('That Agent name is non-existant');
				}

				//Fetches the results in array
				$results = mysql_fetch_assoc( $results );
				
				//registration date
				$storeg = $results['user_registered'];

				//hashed password
				$stopass = $results['user_pass'];

				//same action used at the register.php
				$nonce = md5('registration-' . $subname . $storeg . NONCE_SALT);

				//this is my verification to see if the password matches when they log in with the one they used when registered
				$subpass = $jdb->hash_password($subpass, $nonce);

				
				if ( $subpass == $stopass ) {
					
					//if the passwords match, this is stored in a cookie
					$authnonce = md5('cookie-' . $subname . $storeg . AUTH_SALT);
					$authID = $jdb->hash_password($subpass, $authnonce);
					
					//authorization
					setcookie('chriscookies[user]', $subname, 0, '', '', '', true);
					setcookie('chriscookies[authID]', $authID, 0, '', '', '', true);
					
					//redirects
					$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
					$redirect = str_replace('login.php', $redirect, $url);
					
					//goes back to the home page for simple funtionality
					header("Location: $redirect");
					exit;	
				} else {
					return 'invalid';
				}
			} else {
				return 'empty';
			}
		}
		
		function logout() {
			//logs the user out
			$idout = setcookie('chriscookies[authID]', '', -3600, '', '', '', true);
			$userout = setcookie('chriscookies[user]', '', -3600, '', '', '', true);
			
			if ( $idout == true && $userout == true ) {
				return true;
			} else {
				return false;
			}
		}
		
		function checkLogin() {
			global $jdb;
		
			//grabs the authorization that we set above
			$cookie = $_COOKIE['chriscookies'];
			$user = $cookie['user'];
			$authID = $cookie['authID'];
			
			
			if ( !empty ( $cookie ) ) {
				$table = 'je';
				$sql = "SELECT * FROM $table WHERE user_login = '" . $user . "'";
				$results = $jdb->select($sql);

				
				if (!$results) {
					die('That agent name is non-existant');
				}
                                $results = mysql_fetch_assoc( $results );
                                $storeg = $results['user_registered'];
                                $stopass = $results['user_pass'];
                                $authnonce = md5('cookie-' . $user . $storeg . AUTH_SALT);
				$stopass = $jdb->hash_password($stopass, $authnonce);
				//checks for matching password stored in the cookie vs submitted
				if ( $stopass == $authID ) {
					$results = true;
				} else {
					$results = false;
				}
			} else {
				$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
				$redirect = str_replace('index.php', 'login.php', $url);
				header("Location: $redirect?msg=login");
				exit;
			}
			
			return $results;
		}
	}
}


$j = new cb367;
?>