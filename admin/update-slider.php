<?php
include '../connection.inc';
if(isset($_REQUEST['id'])){

	$id = $_REQUEST['id'];
	$alt = 	$_REQUEST['altTag'];
	$topText = 	$_REQUEST['topText'];
	$bottomText = 	$_REQUEST['bottomText'];
	
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
					
				$q = "UPDATE slider 
					SET url = 'images/uploads/$newFile', alt = '$alt',  top_text='$topText', bottom_text='$bottomText'
					WHERE id_slider = $id";
					
				$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
				
				echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";
			}
			else{
				echo "<div class='alert alert-danger item-changed'><strong>Image upload error</strong></div>";
			}
		}
		else{
			$q = "UPDATE slider 
					SET alt = '$alt',  top_text='$topText', bottom_text='$bottomText'
					WHERE id_slider = $id";
					
				$r = mysqli_query($conn, $q) or die("<div class='alert alert-danger item-changed'><strong>Error in query</strong></div>");
				
				echo "<div class='alert alert-success'><strong>Update successful!</strong></div>";
		}
	}
	
	
	
}
else{
	
	echo "<div class='alert alert-danger item-changed'><strong>Error during the update</strong></div>";
	
}


?>