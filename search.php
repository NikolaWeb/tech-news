<?php
	include "connection.inc";
?>

<?php
		if(isset($_REQUEST['search'])){
			$search = $_REQUEST['search'];
			
			$query="SELECT * FROM product WHERE (name LIKE '%$search%' OR description LIKE '%$search%' OR excerpt LIKE '%$search%') ORDER BY id_product DESC ";
			
			$result = mysqli_query($conn, $query);
			
			if(mysqli_num_rows($result)>0) {
				echo "<h4 id='searchTitle'> Results for the term: <span class='text-primary'>". $search. "</span></h4>";
				
				while($r = mysqli_fetch_array($result)):
				$oldprice = $r['price'] + 30;
?>
					<div class='col-sm-4 space-bottom'>
						<div><a class="image-hover" href='?page=3&course=<?php echo $r['id_product']; ?>'><img class='img-responsive' src='<?php echo $r['image_url']; ?>' alt='<?php echo $r["alt"]; ?>'/></a></div>
						<a href='index.php?course="<?php echo $r['id_product']; ?>'><h4><?php echo $r['name']; ?></h4></a>
						<h5><span class='strike-price'>$ <?php echo $oldprice; ?>"</span> <span class='actual-price'>$ <?php echo $r['price']; ?></span></h5>
						<form action="index.php?page=5&action=add&id=<?php echo $r['id_product'] ?>" method="POST">
							<input type="hidden" name="hidden_image" value="<?php echo $r['image_url']; ?>" />
							<input type="hidden" name="hidden_price" value="<?php echo $r['price']; ?>" />
							<input type="hidden" name="hidden_name" value="<?php echo $r['name']; ?>" />				
							<button name="addToCart" class='btn btn-lg btn-primary btn-block'><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
						</form>
					</div>
<?php 
				endwhile; 

			}
			else{
				echo "<div class='alert alert-warning'>
						<strong>No results!</strong>
					</div>";
			}
		}
?>