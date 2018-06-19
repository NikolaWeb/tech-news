<?php

if(isset($_REQUEST['page'])&& isset($_REQUEST['order'])){
	if(is_numeric($_REQUEST['order'])){
		$order = trim($_REQUEST['order']);
		
		$query = "SELECT * FROM slider WHERE id_slider = $order";
		$r=mysqli_query($conn, $query);
			if(mysqli_num_rows($r) == 0){
				echo "There are no items!";
			}
			else{
						
				$r= mysqli_fetch_array($r);
					
				?>
				<div class="col-sm-9">
				
					<form class="order" id="edit_item" method="POST" action = "" enctype="multipart/form-data">
					
						<input type="hidden" id="id"  name ="id" value="<?php echo $r['id_slider']; ?>" />
					
						<div class="form-group">						
							<img src="../<?php echo $r['url']; ?>" alt="Slider image" class="img-responsive img-panel-slider" />						
						</div>
						<div class="form-group">
							<label for="altTag">Alt</label>
							<input type="text" id="altTag"  name="altTag" value="<?php echo $r['alt']; ?>" class="form-control" />
						</div>					
						<div class="form-group">
							<label for="topText">Top text</label>
							<input type="text" id="topText" name="topText" value="<?php echo $r['top_text']; ?>" class="form-control" /> 
						</div>
						<div class="form-group">
							<label for="bottomText">Bottom text</label>
							<input type="text" id="bottomText" name="bottomText" value="<?php echo $r['bottom_text']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label class="btn btn-default">
								Browse images <input class="myImg" name="uploadImage" id="uploadImage" type="file" hidden>
							</label> <span class="text-warning">Recommended size is 1920x600px</span>
						</div>
						<div class="form-group">
							<input type="submit" class="edit_item btn btn-lg btn-primary" value="Confirm editing"/>
						</div>
					
					</form>
				
					<div class="rez"></div>
				</div>
<?php
		}	
	}
	else{
		echo "<div class='alert alert-danger item-changed'><strong>Image upload error</strong></div>";
	}
	

}
else if(isset($_REQUEST['page'])){
	
	$messageAdd = "";
	if(isset($_REQUEST['addItem'])){
		$alt = 	$_REQUEST['altTag'];
		$topText = 	$_REQUEST['topText'];
		$bottomText = 	$_REQUEST['bottomText'];
		
		
		$path = "../images/uploads/";
		$fileName = $_FILES['uploadImageNew']['name'];
		$tmpImage = $_FILES['uploadImageNew']['tmp_name'];
		$size = $_FILES['uploadImageNew']['size'];
		$type = $_FILES['uploadImageNew']['type'];
		$errors = $_FILES['uploadImageNew']['type'];
		
		$newFile = time()."_".$fileName;
		
		if($errors > 0){
			echo "<div class='alert alert-danger item-changed'><strong>Image upload error</strong></div>";
		}
		else{
			if(move_uploaded_file($tmpImage, $path.$newFile)){
				
				$query = "INSERT INTO slider (id_slider, url, alt, top_text, bottom_text) VALUES (NULL, 'images/uploads/$newFile', '$alt', '$topText', '$bottomText')";
				if (mysqli_query($conn, $query)) {
					
					$messageAdd = "<div class='alert alert-success item-changed'><strong>New record created successfully</strong></div>";
				} 
				else {
					$messageAdd = "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}
		}
	}

?>
<button id="addItemBtn" class="btn btn-lg btn-primary btn-block">Add new item</button>
<div id = "addItemDiv">		
	<form action ="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="alt">Alt</label>
			<input type="text" id="altTag" name="altTag" class="form-control" />
		</div>
		<div class="form-group">
			<label for="topText">Top text</label>
			<input type="text" id="topText" name="topText" class="form-control" />
		</div>
		<div class="form-group">
			<label for="bottomText">Bottom text</label>
			<input type="text" id="bottomText" name="bottomText" class="form-control" />
		</div>
		<div class="form-group">
			<label class="btn btn-default">
				Browse images <input class="myImg" name="uploadImageNew" id="uploadImageNew" type="file" hidden>
			</label> <span class="text-warning">Recommended size is 1920x600px</span>
		</div>
		<div class="form-group">
			<input type="submit" name="addItem" class="btn btn-lg btn-primary" value="Add new slide">
		</div>
	</form>
	
</div>
<?php echo $messageAdd; ?>
<?php //checkbox deletion of slides
if(isset($_POST['delItem']))
{
 $cnt=array();
 $cnt=count($_POST['del']);
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['del'][$i];
     $query="delete from slider where id_slider=".$del_id;
     mysqli_query($conn, $query);
  }
}	
?>
<form method="POST" action="">	
	<table class="table table-bordered">
					<tr>
						<td>
							<select class="form-control form-control-sm">
								<option value = "0" >Choose...</option>
								<option value = "remove" >Delete selected</option>
							</select>						
						</td>
						<td>
							<input name="delItem" type="submit" value="Confirm" class="btn btn-danger" />
						</td>
					
					</tr>
					<tr>
						<th><input type="checkbox" class="all" name="all" value="all"></th>
						<th>ID</th>
						<th>Image</th>
						<th>Image URL</th>
						<th>ALT</th>
						<th>Image top text</th>
						<th>Image bottom text</th>
						<th>Edit</th>
						<th>Delete</th>
						
					</tr>
					
<?php				
	$q = "SELECT * FROM slider";
	$r=mysqli_query($conn, $q);
	while($data = mysqli_fetch_assoc($r))
	{
		echo "<tr>";
			echo '<td><input type="checkbox" name="del[]" class="rest" value="'.$data["id_slider"].'"></td>';
		?>	
			<td> <?php echo $data['id_slider']; ?> </td>
			<td> <img src="<?php echo "../" . $data['url']; ?>" width="130px" alt="slika"/> </td>
			<td> <?php echo "../" . $data['url']; ?> </td>
			<td> <?php echo $data['alt']; ?> </td>
			<td> <?php echo $data['top_text']; ?> </td>
			<td> <?php echo $data['bottom_text']; ?> </td>
			<td><a href="?page=slider&order=<?php echo $data['id_slider']; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
			<td><a class="del-item" href="delete-slide.php?page=slider&order=<?php echo $data['id_slider'];?>"><i class="glyphicon glyphicon-trash" ></i></a></td>	
		<?php 
		echo "</tr>";
	}

				


?>
	</table>
</form>


<?php				
}
if(isset($_REQUEST['deleted'])):
?>
<div class="alert alert-danger item-changed">
  <strong>Item deleted!</strong>
</div>
<?php endif; ?>


	<script type="text/javascript">
	function obrada(e){
		e.preventDefault();	
		$("#overlay").show();
		$(".rez").show();
		
		var formId = $("#edit_item");
		var formData = new FormData(formId[0]);
		
		$.ajax({
			type:"POST",
			url: "update-slider.php",
			processData: false,
			contentType: false,
			data : formData,
			cache: false,
			success: function(data){
				
				$(".rez").html("<div class='alert alert-success'><strong>Update successful!</strong></div>");
					setTimeout(function(){ $('.rez').fadeOut('slow');
				} , 3000);
				$("#overlay").hide();
					setTimeout(function(){// wait for 5 secs(2)
					location.reload(); // then reload the page.(3)
				}, 3000); 
				
			}, 
			error: function (xhr, ajaxOptions, thrownError){
				alert(xhr.status);
				alert(thrownError);
			}
		});
		
	}
		
	$(document).ready(function(){
			
			//$(".loader").hide();
			$('#edit_item').on("submit", obrada);
			
	});
	
	</script>
