<?php
	if ( $_POST ){
		$UserID = $_POST['UserID'];
		$OtherUserID = $_POST['OtherUserID'];
		//print("$UserID<br/>");
		//print("$OtherUserID<br/>");
	}
	$servername = "tund.cefns.nau.edu";
	$username = "jes445";
	$password = "<jpmdjrntr3S";
	$dbname = "jes445";
				
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$Sql = "DELETE FROM messaging WHERE id='$OtherUserID' AND id2='$UserID'"
	$conn->query( $Sql );
	
	
	
	
	header( 'Location: http://cefns.nau.edu/~jes445/readmessage.php' ) ;

?>