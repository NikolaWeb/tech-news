<?php
include '../connection.inc';
if(isset($_REQUEST['id'])){

	$id = $_REQUEST['id'];
	$pollText = $_REQUEST['pollText'];
	$result = $_REQUEST['result'];
				
	$q = "UPDATE poll
		SET poll_text='$pollText', result = '$result'
		WHERE id_poll = $id";
		
	$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
	
	echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";

	
}
else{
	
	echo "<div class='alert alert-danger item-changed'><strong>Error during the update</strong></div>";
	
}


?>