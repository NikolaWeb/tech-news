<?php

if(isset($_REQUEST['page'])&& isset($_REQUEST['order'])){
	if(is_numeric($_REQUEST['order'])){
		$order = trim($_REQUEST['order']);
		
		$query = "SELECT * FROM product WHERE id_product = $order";
		$r=mysqli_query($conn, $query);
			if(mysqli_num_rows($r) == 0){
				echo "There are no items!";
			}
			else{
						
				$r= mysqli_fetch_array($r);
					
				?>
				<div class="col-sm-9">
				
					<form class="order" id="edit_item" method="POST" action = "" enctype="multipart/form-data">
					
						<input type="hidden" id="id"  name ="id" value="<?php echo $r['id_product']; ?>" />
					
						<div class="form-group">						
							<img src="../<?php echo $r['image_url']; ?>" alt="Product image" class="img-responsive img-panel" />						
						</div>
						<div class="form-group">
							<label for="productName">Name</label>
							<input type="text" id="productName"  name="productName" value="<?php echo $r['name']; ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label for="altTag">Alt</label>
							<input type="text" id="altTag"  name="altTag" value="<?php echo $r['alt']; ?>" class="form-control" />
						</div>					
						<div class="form-group">
							<label for="price">Price</label>
							<input type="text" id="price" name="price" value="<?php echo $r['price']; ?>" class="form-control" /> 
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea id="description" name="description" class="form-control" /><?php echo htmlspecialchars($r['description']); ?> </textarea>
						</div>
						<div class="form-group">
							<label for="excerpt">Excerpt</label>
							<input type="text" id="excerpt" name="excerpt" value="<?php echo htmlspecialchars($r['excerpt']); ?>" class="form-control" />
						</div>
						<div class="form-group">
							<label class="btn btn-default">
								Browse images <input class="myImg" name="uploadImage" id="uploadImage" type="file" hidden>
							</label> <span class="text-warning">Recommended size is 510x510px</span>
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
		$productName = $_REQUEST['productName'];
		$alt = $_REQUEST['altTag'];
		$price = $_REQUEST['price'];
		$description = $_REQUEST['description'];
		$excerpt = $_REQUEST['excerpt'];
		
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
				
				$query = "INSERT INTO product (id_product, name, image_url, alt, price, description, excerpt) VALUES (NULL, '$productName', 'images/uploads/$newFile', '$alt', $price, '$description', '$excerpt')";
				
				if (mysqli_query($conn, $query)) {
					$messageAdd = "<div class='alert alert-success item-changed'><strong>New record created successfully</strong></div>";
				} else {
					$messageAdd = "Error: " . "<br>" . mysqli_error($conn);
				}
			}
		}
	}

?>
<button id="addItemBtn" class="btn btn-lg btn-primary btn-block">Add new item</button>
<div id="addItemDiv">			
	<form action ="" method="POST" enctype="multipart/form-data">		
		<div class="form-group">
			<label for="productName">Name</label>
			<input type="text" id="productName" name="productName"  class="form-control" />
		</div>
		<div class="form-group">
			<label for="altTag">Alt</label>
			<input type="text" id="altTag"  name="altTag" class="form-control" />
		</div>					
		<div class="form-group">
			<label for="price">Price in dollars</label>
			<input type="text" id="price" name="price" class="form-control" /> 
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea id="description" name="description" class="form-control" /> </textarea>
		</div>
		<div class="form-group">
			<label for="excerpt">Excerpt</label>
			<input type="text" id="excerpt" name="excerpt" class="form-control" />
		</div>
		<div class="form-group">
			<label class="btn btn-default">
				Browse images <input class="myImg" name="uploadImageNew" id="uploadImageNew" type="file" hidden>
			</label>
		</div>
		<div class="form-group">
			<input type="submit" name="addItem" class="btn btn-lg btn-primary" value="Add item">
		</div>
	</form>
	
</div>
<?php echo $messageAdd; ?>
<?php //checkbox deletion of items
if(isset($_POST['delItem']))
{
 $cnt=array();
 $cnt=count($_POST['del']);
 for($i=0;$i<$cnt;$i++)
  {
     $del_id=$_POST['del'][$i];
     $query="delete from product where id_product=".$del_id;
     mysqli_query($conn, $query);
  }
}	
?>
<form method="POST" action="">

	
	

	
	<table class="table table-bordered">
					<tr>
						<td style="width: 120px;">
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
						<th>Name</th>
						<th>ALT</th>
						<th>Price</th>
						<th>Description</th>
						<th>Excerpt</th>
						<th>Edit</th>
						<th>Delete</th>
						
					</tr>
					
<?php
	if(!isset($_REQUEST['paginate']) || !is_numeric($_REQUEST['paginate'])){
		$paginate = 1;
	}
	else{
		$paginate = $_REQUEST['paginate'];
	}
	$onPage = 4;
		
	$q = "SELECT * FROM product";
	$rn = mysqli_query($conn, $q);
	if($resultNumber = mysqli_num_rows($rn)){
		$numberPaginate = ceil($resultNumber / $onPage);

        $firstResult = ($paginate-1) * $onPage;

        $sql = "SELECT * FROM product ORDER BY id_product DESC LIMIT ".$firstResult . ','.$onPage;

        $rec = mysqli_query($conn, $sql);
		
		while($data = mysqli_fetch_assoc($rec))
		{
			echo "<tr>";
				echo '<td><input type="checkbox" name="del[]" class="rest" value="'.$data["id_product"].'"></td>';
			?>	
				<td> <?php echo $data['id_product']; ?> </td>
				<td> <img src="<?php echo "../" . $data['image_url']; ?>" width="130px" alt="slika"/> </td>
				<td> <?php echo $data['name']; ?> </td>
				<td> <?php echo $data['alt']; ?> </td>
				<td> <?php echo "$ ".$data['price']; ?> </td>
				<td> <?php echo mb_strimwidth($data['description'], 0, 250, "..."); ?> </td>
				<td> <?php echo htmlspecialchars($data['excerpt']); ?> </td>
				<td><a href="?page=products&order=<?php echo $data['id_product']; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
				<td><a class="del-item" href="delete-product.php?page=products&order=<?php echo $data['id_product'];?>"><i class="glyphicon glyphicon-trash" ></i></a></td>	
			<?php 
			echo "</tr>";
		}

				


?>
	</table>
</form>
	<div class='row text-center'>
        <ul class='pagination'>
	<?php
        for($str=1; $str<=$numberPaginate; $str++){
            if($str == $paginate){
                echo "<li><a class='active-link' href='admin.php?page=products&paginate=".$str."'>".$str."</a></li>";
            }
            else {
                echo "<li><a href='admin.php?page=products&paginate=" . $str . "'>" . $str . "</a></li>";
            }
        }
	?>
        <ul>
	</div>

<?php	
	}
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
			url: "update-product.php",
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
