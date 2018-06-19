<?php	

	$messageSuccess = "";
	$messageDanger = "";
	if(isset($_POST['vote'])){
		if(!empty($_POST['pollVote'])){
		
			$pollVote = $_POST['pollVote'];
			
			$query2 = "UPDATE poll SET result=result+1 WHERE id_poll=".$pollVote;
			
			$rez2 = mysqli_query($conn, $query2);
			if($rez2){
				$messageSuccess = "<span class='text-success'>Your vote is noted!</span>";
			}
		}
		else{
			$messageDanger = "<span class='text-danger'>You have to choose an answer!</span>";
		}
	}
	
	if(isset($_POST['results'])){
		$query3 = "SELECT * FROM poll";
		$res3 = mysqli_query($conn, $query3);
		while($r3 = mysqli_fetch_array($res3)){
			$results[] = $r3;
		}
	}
	
	
?>

<div class='space-bottom'>
	<div class="well well-lg">
		<form method="POST" action="">						  
			<div class="form-group">
				<h4>Which is your favorite genre?</h4>
				
			</div>
			<div class="form-group">
				<?php 
					$query1 = "SELECT * FROM poll";
					$res1 = mysqli_query($conn, $query1);
					while($r1 = mysqli_fetch_array($res1)):
				?>
					
					<input id="<?php echo $r1['id_poll']; ?>" value="<?php echo $r1['id_poll']; ?>" type="radio" name="pollVote">
					<label class="pollLabel" for="<?php echo $r1['id_poll']; ?>"><?php echo $r1['poll_text']; ?></label><br/>
				
				<?php endwhile; ?>
			</div>
			
			<div class="form-group">
			<?php if (isset($_SESSION['role'])): ?>
				<input name="vote" class="btn btn-success" value="Vote" type="submit">
			<?php else: ?>
				 <span class="text-warning">You need to be signed in to vote!</span>
			<?php endif; ?>
				<input id="showResults" name="results" class="btn btn-info" value="Results" type="submit">
			</div>
			
			
				<?php echo $messageSuccess; ?>
				<?php echo $messageDanger; ?>
			
			
			<?php if(isset($_POST['results'])): ?>
				<table class="table table-bordered">
					<?php 
						$i = 0;
						foreach($results as $result){
							++$i;
							
								echo "<tr>";
								echo "<td>". $result['poll_text'] ."</td><td>". $result['result'] ."</td>";
								echo "</tr>";
							
							
						}
					?>
				</table>
			<?php endif; ?>
		</form>


	</div>
</div>

