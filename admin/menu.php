<?php

if(isset($_REQUEST['page'])&& isset($_REQUEST['order'])){
	if(is_numeric($_REQUEST['order'])){
		$order = trim($_REQUEST['order']);
		
		$query = "SELECT * FROM menu WHERE id_menu = $order";
		$r=mysqli_query($conn, $query);
			if(mysqli_num_rows($r) == 0){
				echo "There are no items!";
			}
			else{
						
				$r= mysqli_fetch_array($r);
					
				?>
				<div class="col-sm-9">
				
					<form class="order" id="edit_item" method="POST" action = "">
					
						<input type="hidden" id="id"  name ="id" value="<?php echo $r['id_menu']; ?>" />
					
						<div class="form-group">
							<label for="pageName">Page name</label>
							<input type="text" id="pageName"  name="pageName" value="<?php echo $r['name']; ?>" class="form-control" />
						</div>					
						<div class="form-group">
							<label for="slug">Slug</label>
							<input type="text" id="slug" name="slug" value="<?php echo $r['slug']; ?>" class="form-control" /> 
						</div>
						<div class="form-group">
							<label for="url">Url</label>
							<input type="text" id="url" name="url" value="<?php echo $r['url']; ?>" class="form-control" /> 
						</div>
						<div class="form-group">
							<label for="keywords">Keywords</label>
							<input type="text" id="keywords" name="keywords" value="<?php echo $r['keywords']; ?>" class="form-control" /> 
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea id="description" name="description" class="form-control"><?php echo $r['description']; ?></textarea>
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
		echo "<div class='alert alert-danger item-changed'><strong>Page does not exist!</strong></div>";
	}
	

}
else if(isset($_REQUEST['page'])){

	$messageAdd = "";
	if(isset($_REQUEST['addItem'])){
		$pageName = $_REQUEST['pageName'];
		$slug = $_REQUEST['slug'];
		$url = $_REQUEST['url'];
		$keywords = $_REQUEST['keywords'];
		$description = $_REQUEST['description'];
		
		$query = "INSERT INTO menu (id_menu, name, slug, url, keywords, description) VALUES (NULL, '$pageName', '$slug', '$url', '$keywords', '$description')";
		
		if (mysqli_query($conn, $query)) {
			
			$messageAdd = "<div class='alert alert-success item-changed'><strong>New record created successfully</strong></div>";
		} else {
			$messageAdd = "Error: " . "<br>" . mysqli_error($conn);
		}
	}

?>
<button id="addItemBtn" class="btn btn-lg btn-primary btn-block">Add new item</button>
<div id = "addItemDiv">		
	<form action ="" method="POST">
		<div class="form-group">
			<label for="pageName">Page name</label>
			<input type="text" id="pageName" name="pageName" class="form-control" />
		</div>
		<div class="form-group">
			<label for="slug">Slug</label>
			<input type="text" id="slug" name="slug" class="form-control" />
		</div>
		<div class="form-group">
			<label for="url">URL</label>
			<input type="text" id="url" name="url" class="form-control" />
		</div>
		<div class="form-group">
			<label for="keywords">Keywords</label>
			<input type="text" id="keywords" name="keywords" class="form-control" />
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<textarea id="description" name="description" class="form-control" /></textarea>
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
     $query="DELETE FROM menu WHERE id_menu=".$del_id;
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
			<th>Page name</th>
			<th>Slug</th>
			<th>URL</th>
			<th>Keywords</th>
			<th>Description</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
					
<?php				
	$q = "SELECT * FROM menu";
	$r=mysqli_query($conn, $q);
	while($data = mysqli_fetch_assoc($r))
	{
		echo "<tr>";
			echo '<td><input type="checkbox" name="del[]" class="rest" value="'.$data["id_menu"].'"></td>';
		?>	
			<td> <?php echo $data['id_menu']; ?> </td>
			<td> <?php echo $data['name']; ?> </td>
			<td> <?php echo $data['slug']; ?> </td>
			<td> <?php echo $data['url']; ?> </td>
			<td> <?php echo $data['keywords']; ?> </td>
			<td> <?php echo $data['description']; ?> </td>
			<td><a href="?page=menu&order=<?php echo $data['id_menu']; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
			<td><a class="del-item" href="delete-menu.php?page=menu&order=<?php echo $data['id_menu'];?>"><i class="glyphicon glyphicon-trash" ></i></a></td>	
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
			url: "update-menu.php",
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