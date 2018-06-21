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

            $createdTimestamp = $r->created_at;

            $createdAt = date("H:i | d M Y",  $createdTimestamp);

			?>
			

			<div class="col-sm-8">
				<div class="row">
                    <div class='col-sm-12 space-bottom-2 text-left'>
                        <h1><?= $r->name; ?></h1>
                        <p><small>Posted at: <?= $createdAt; ?></small></p>
                        <?= $r->excerpt; ?>
                    </div>
					<div class='col-sm-12 space-bottom-2'>
						<img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->name; ?>'/>
					</div>
					<div class='col-sm-12 space-bottom text-left'>
						<?= $r->description; ?>
					</div>
				</div>
                <?php include "modules/comments.php"; ?>
			</div>
			<div class='col-sm-4 text-left space-top-2'>
                <div class="well well-lg">
                    <?php if(isset($_SESSION['user'])): ?>
                        <span>Add this article to favorites? </span><button data-id="<?= $r->id_news; ?>" name="addToFavorites" class='btn btn-sm btn-primary atc heart-single'><span class="glyphicon glyphicon-heart"></span></button>
                    <?php else: ?>
                        <h4>You need to be signed in to use favorites!</h4>
                    <?php endif; ?>
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
<div id="addedToFav" class="alert alert-info">
</div>