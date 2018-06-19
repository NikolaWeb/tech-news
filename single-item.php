<div class="container text-center">
  <div class="row">
	<?php
		$idNews = $_GET['news'];
		$query = "SELECT * FROM news WHERE id_news = $idNews";

		//ako stranica ne postoji ili su parametar slova 
		if(!isset($_GET['news']) || !is_numeric($_GET['news'])){
			include '404.php';
		}
		
		else{

            $resultNumber = $conn->query($query);
            $numRows = $resultNumber->rowCount();
            if($resultNumber->rowCount() > 0):

            $r = $resultNumber->fetch();
			
			$oldprice = $r->price + 30;
			?>
			
			<h1><?= $r->name; ?></h1>
			<div class="col-sm-8">
				<div class="row">
					<div class='col-sm-6 space-bottom'>
						<img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->alt; ?>'/>
					</div>
					<div class='col-sm-6 space-bottom text-left'>
						<?= $r->description; ?>
					</div>
				</div>
				<div class="row space-bottom">
					<h4><?= $r->excerpt; ?></h4>
				</div>
                <?php include "modules/comments.php"; ?>
			</div>
			<div class='col-sm-4'>
			<div class="well well-lg">
				<h3><?= $r->name; ?></h3>
				<h4>One payment of:</h4>				
				<h5><span class='strike-price'>$ <?= $oldprice; ?>"</span> <span class='actual-price'>$ <?= $r->price; ?></span></h5>
				<form action="index.php?page=5&action=add&id=<?= $r->id_news; ?>" method="POST">
				<input type="hidden" name="hidden_image" value="<?= $r->image_url; ?>" />
				<input type="hidden" name="hidden_price" value="<?= $r->price; ?>" />
				<input type="hidden" name="hidden_name" value="<?= $r->name; ?>" />
				<button name="addToCart" class='btn btn-lg btn-primary btn-block'><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
				</form>
			</div>
			<?php
				include "poll.php";
			?>
			</div>
			
				
  </div>
  
	<?php	endif;
		}
	?>
  	
</div>