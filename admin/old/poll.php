<?php

if(isset($_REQUEST['page'])&& isset($_REQUEST['order'])){
	if(is_numeric($_REQUEST['order'])){
		$order = trim($_REQUEST['order']);
		
		$query = "SELECT * FROM poll WHERE id_poll = $order";
		$r=mysqli_query($conn, $query);
			if(mysqli_num_rows($r) == 0){
				echo "There are no items!";
			}
			else{
						
				$r= mysqli_fetch_array($r);
					
				?>
				<div class="col-sm-9">
				
					<form class="order" id="edit_item" method="POST" action = "">
					
						<input type="hidden" id="id"  name ="id" value="<?php echo $r['id_poll']; ?>" />
					
						<div class="form-group">
							<label for="poll_text">Poll text</label>
							<input type="text" id="pollText"  name="pollText" value="<?php echo $r['poll_text']; ?>" class="form-control" />
						</div>					
						<div class="form-group">
							<label for="result">Result</label>
							<input type="text" id="result" name="result" value="<?php echo $r['result']; ?>" class="form-control" /> 
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
		$pollText = $_REQUEST['pollText'];
		$result = 	$_REQUEST['result'];
		
		$query = "INSERT INTO poll (id_poll, poll_text, result) VALUES (NULL, '$pollText', '$result')";
		
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
			<label for="pollText">Poll text</label>
			<input type="text" id="pollText" name="pollText" class="form-control" />
		</div>
		<div class="form-group">
			<label for="result">Result</label>
			<input type="text" id="result" name="result" class="form-control" />
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
     $query="DELETE FROM poll WHERE id_poll=".$del_id;
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
			<td style="width: 120px;">
				<input name="delItem" type="submit" value="Confirm" class="btn btn-danger" />
			</td>
		
		</tr>
		<tr>
			<th><input type="checkbox" class="all" name="all" value="all"></th>
			<th>ID</th>
			<th>Poll text</th>
			<th>Result</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
					
<?php				
	$q = "SELECT * FROM poll";
	$r=mysqli_query($conn, $q);
	while($data = mysqli_fetch_assoc($r))
	{
		echo "<tr>";
			echo '<td><input type="checkbox" name="del[]" class="rest" value="'.$data["id_poll"].'"></td>';
		?>	
			<td> <?php echo $data['id_poll']; ?> </td>
			<td> <?php echo $data['poll_text']; ?> </td>
			<td> <?php echo $data['result']; ?> </td>
			<td><a href="?page=poll&order=<?php echo $data['id_poll']; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
			<td><a class="del-item" href="delete-poll.php?page=poll&order=<?php echo $data['id_poll'];?>"><i class="glyphicon glyphicon-trash" ></i></a></td>	
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
			url: "update-poll.php",
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
