<?php
include '../connection.inc';
if(isset($_REQUEST['id'])){

	$id = $_REQUEST['id'];
	$productName = $_REQUEST['productName'];
	$alt = $_REQUEST['altTag'];
	$price = $_REQUEST['price'];
	$description = 	htmlspecialchars($_REQUEST['description']);
	$excerpt = 	htmlspecialchars($_REQUEST['excerpt']);
	
	$path = "../images/uploads/";
	$fileName = $_FILES['uploadImage']['name'];
	$tmpImage = $_FILES['uploadImage']['tmp_name'];
	$size = $_FILES['uploadImage']['size'];
	$type = $_FILES['uploadImage']['type'];
	$errors = $_FILES['uploadImage']['type'];
	
	$newFile = time()."_".$fileName;
	
	if($errors > 0){
		echo "<div class='alert alert-danger item-changed'><strong>Image upload error</strong></div>";
	}
	else{
		if(!empty($_FILES['uploadImage']['name'])){
			if(move_uploaded_file($tmpImage, $path.$newFile)){
					
				$q = "UPDATE product
					SET image_url = 'images/uploads/$newFile', name = '$productName', alt = '$alt',  price = $price, description='$description', excerpt = '$excerpt'
					WHERE id_product = $id";
					
				$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
				
				echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";
			}
			else{
				echo "<div class='alert alert-danger item-changed'><strong>Image upload error</strong></div>";
			}
		}
		else{
			$q = "UPDATE product
					SET image_url = 'images/uploads/$newFile', name = '$productName', alt = '$alt',  price = $price, description='$description', excerpt = '$excerpt'
					WHERE id_product = $id";
					
				$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
				
				echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";
		}
	}
	
	
	
}
else{
	
	echo "<div class='alert alert-danger item-changed'><strong>Error during the update</strong></div>";
	
}


?>