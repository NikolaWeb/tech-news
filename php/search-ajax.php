<?php
	include "connection.php";
?>

<?php
		if(isset($_REQUEST['search'])){
			$search = $_REQUEST['search'];
			
			$query="SELECT * FROM news WHERE (name LIKE '%$search%' OR description LIKE '%$search%' OR excerpt LIKE '%$search%') ORDER BY id_news DESC ";

            $rows = $conn->query($query);
			
			if($rows->rowCount() > 0) {
                $results = $rows->fetchAll();
				
				foreach($results as $r):

?>
                    <div class='col-md-12 space-bottom'>
                        <div class='col-md-6'>
                            <a class="image-hover" href='?page=3&news=<?= $r->id_news; ?>'><img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->alt; ?>'/></a>
                        </div>
                        <div class='col-md-6'>
                            <a href='?page=3&news=<?= $r->id_news; ?>'><h4><?= $r->name; ?></h4></a>
                            <h5><span class='strike-price'>$ <?= $oldprice; ?>"</span> <span class='actual-price'>$ <?= $r->price; ?></span></h5>
                            <button data-id="<?= $r->id_news; ?>" name="addToFavorites" class='btn btn-sm btn-primary atc'><span class="glyphicon glyphicon-heart"></span></button>
                        </div>
                    </div>
<?php 
				endforeach;

			}
			else{
				echo "<div class='alert alert-warning'>
						<strong>No results!</strong>
					</div>";
			}
		}
?>