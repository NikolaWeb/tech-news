<?php
	include "slider.php";
?>
<div class="container text-center">
  <h2>Latest news</h2><br>
  <div class="row">
  <?php
	$query = "SELECT * FROM news ORDER BY id_news DESC LIMIT 3";

     $res = $conn->query($query)->fetchAll();
	
	foreach($res as $r):
  ?>
    <div class="col-sm-4 space-bottom">
      <div><a class="image-hover" href='?page=3&news=<?php echo $r->id_news; ?>'><img class='img-responsive' src='<?php echo $r->image_url; ?>' alt='<?php echo $r->name; ?>'/></a></div>
      <a href='index.php?page=3&news="<?php echo $r->id_news; ?>'><h4><?php echo $r->name; ?></h4></a>
    </div>
   
	<?php
		endforeach;
	?>
  </div>
</div>