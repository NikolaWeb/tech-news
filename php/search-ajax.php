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

                    $createdTimestamp = $r->created_at;

                    $createdAt = date("H:i | d M Y",  $createdTimestamp);
                    ?>
                    <div class='row space-bottom news-post'>
                        <div class='col-md-6'>
                            <a class="image-hover" href='?page=3&news=<?= $r->id_news; ?>'><img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->name; ?>'/></a>
                        </div>
                        <div class='col-md-6'>
                            <a href='?page=3&news=<?= $r->id_news; ?>'><h4><?= $r->name; ?></h4></a>
                            <p><small><?= $createdAt ?></small></p>
                            <?php if(isset($_SESSION['user'])): ?>
                                <button data-id="<?= $r->id_news; ?>" name="addToFavorites" class='btn btn-sm btn-primary atc'><span class="glyphicon glyphicon-heart"></span></button>
                            <?php endif; ?>
                            <p class="top10"><?= $r->excerpt; ?></p>
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