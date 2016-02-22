<?php
// My database class
if(!class_exists('chrisDatabase')){
	class chrisDatabase {
	
		
		function chrisDatabase() {
			return $this->__construct();
		}
		//construct function is a special method that is specified when this class is instantiated
                function __construct() {
			$this->connect();
                        
                }

		function connect() {
			$link = mysql_connect('tund.cefns.nau.edu', DB_USER, DB_PASS);

			if (!$link) {
				die('Could not connect: ' . mysql_error());
			}

			$db_selected = mysql_select_db(DB_NAME, $link);

			if (!$db_selected) {
				die('Can\'t use ' . DB_NAME . ': ' . mysql_error());
			}
		}   //When a form submission happens and mysql_real_escape_string will clean our database data
		function clean($array) {
			return array_map('mysql_real_escape_string', $array);
		}
		//generates a hash value that I found in the php manual on the internet.
		function hash_password($password, $nonce) {
		  $secureHash = hash_hmac('sha512', $password . $nonce, SITE_KEY);
		  return $secureHash;
		}
                function insert($link, $table, $fields, $values) {
			$fields = implode(", ", $fields); 
			$values = implode("', '", $values);

                        $sql="INSERT INTO $table (id, $fields) VALUES ('', '$values')";
                        if (!mysql_query($sql)) {
				die('Error: ' . mysql_error());
			} else {
				return TRUE;
			}
		}
		function select($sql) {
			$results = mysql_query($sql);
			
			return $results;
		}
	}
}

//instantiates my Database for all of my above funtions.
$jdb = new chrisDatabase;
?>