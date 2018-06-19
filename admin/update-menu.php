<?php
include '../connection.inc';
if(isset($_REQUEST['id'])){

	$id = $_REQUEST['id'];
	$pageName = $_REQUEST['pageName'];
	$slug = $_REQUEST['slug'];
	$url = $_REQUEST['url'];
	$keywords = $_REQUEST['keywords'];
	$description = $_REQUEST['description'];
				
	$q = "UPDATE menu
		SET name='$pageName', slug = '$slug', url = '$url', keywords = '$keywords', description = '$description'
		WHERE id_menu = $id";
		
	$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
	
	echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";

	
}
else{
	
	echo "<div class='alert alert-danger item-changed'><strong>Error during the update</strong></div>";
	
}


?>