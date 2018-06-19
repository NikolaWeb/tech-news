<div class="container">
    <h1 class="text-center">News</h1>
	
    <div class="row">
		<div class="col-md-4 col-md-offset-4 space-bottom-2 form-signin">
			
				<input id="search" type="text" name="search" class="form-control" placeholder="Search news here..." />
				
		</div>
	</div>
	
	<div class="row" id="searchResults">
    <?php
    if(!isset($_REQUEST['paginate']) || !is_numeric($_REQUEST['paginate'])){
        $paginate = 1;
    }
    else{
        $paginate = $_REQUEST['paginate'];
    }
    $onPage = 4;
    $query = "SELECT * FROM news";
    $resultNumber = $conn->query($query);
    $numRows = $resultNumber->rowCount();
    if($resultNumber->rowCount() > 0){
        $numberPaginate = ceil($numRows / $onPage);


        $firstResult = ($paginate-1) * $onPage;

        $sql = "SELECT * FROM news ORDER BY id_news DESC LIMIT ".$firstResult . ','.$onPage;

        $results = $conn->query($sql)->fetchAll();
		
        foreach($results as $r):

            $createdTimestamp = $r->created_at;

            $createdAt = date("H:i | d M Y",  $createdTimestamp);
		?>
            <div class='col-md-12 space-bottom'>
                <div class='col-md-6'>
                    <a class="image-hover" href='?page=3&news=<?= $r->id_news; ?>'><img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->alt; ?>'/></a>
                </div>
                <div class='col-md-6'>
                    <a href='?page=3&news=<?= $r->id_news; ?>'><h4><?= $r->name; ?></h4></a>
                    <p><small><?= $createdAt ?></small></p>
                    <?php if(isset($_SESSION['user'])): ?>
                    <button data-id="<?= $r->id_news; ?>" name="addToFavorites" class='btn btn-sm btn-primary atc'><span class="glyphicon glyphicon-heart"></span></button>
                    <?php endif; ?>
                </div>
            </div>

		<?php
        endforeach;
		?>	
    </div>
	<div class='row text-center' id="paginationWrapper">
        <ul class='pagination'>
	<?php
        for($str=1; $str<=$numberPaginate; $str++){
            if($str == $paginate){
                echo "<li><a class='active-link' href='index.php?page=3&paginate=".$str."'>".$str."</a></li>";
            }
            else {
                echo "<li><a href='index.php?page=3&paginate=" . $str . "'>" . $str . "</a></li>";
            }
        }
	?>
        <ul>
	</div>
	<?php
    }
	?>
               
</div>
<div id="addedToFav" class="alert alert-info">
</div>