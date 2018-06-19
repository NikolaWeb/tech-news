<div class="container text-center">
    <h1>Favorites</h1>

    <div class="row">
        <div class="col-md-4 col-md-offset-4 space-bottom-2 form-signin">

            <input id="search" type="text" name="search" class="form-control" placeholder="Search newss here..." />

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
        $onPage = 6;
        $query = "SELECT * FROM news p INNER JOIN favorite f WHERE p.id_news = f.news_id";
        $resultNumber = $conn->query($query);
        $numRows = $resultNumber->rowCount();

        if($resultNumber->rowCount() > 0){
        $numberPaginate = ceil($numRows / $onPage);



        $firstResult = ($paginate-1) * $onPage;

        $user_id = $_SESSION['user']->id_user;

        $sql = "SELECT * FROM favorite f INNER JOIN news p ON f.news_id = p.id_news WHERE f.news_id = p.id_news AND f.user_id = $user_id  ORDER BY id_favorite DESC LIMIT ".$firstResult . ','.$onPage;

        $results = $conn->query($sql)->fetchAll();

        foreach($results as $r):

            $oldprice = $r->price + 30;
            ?>
            <div class='col-sm-4 space-bottom'>
                <div><a class="image-hover" href='?page=3&news=<?= $r->id_news; ?>'><img class='img-responsive' src='<?= $r->image_url; ?>' alt='<?= $r->alt; ?>'/></a></div>
                <a href='index.php?news="<?= $r->id_news; ?>'><h4><?= $r->name; ?></h4></a>
                <h5><span class='strike-price'>$ <?= $oldprice; ?>"</span> <span class='actual-price'>$ <?= $r->price; ?></span></h5>
                <button data-id="<?= $r->id_news; ?>" data-name="<?= $r->name; ?>" data-image="<?= $r->image_url; ?>" data-price="<?= $r->price; ?>" name="addToCart" class='btn btn-lg btn-primary btn-block atc'><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>
            </div>

        <?php
        endforeach;
        ?>
    </div>
    <div class='row' id="paginationWrapper">
        <ul class='pagination'>
            <?php
            for($str=1; $str<=$numberPaginate; $str++){
                if($str == $paginate){
                    echo "<li><a class='active-link' href='index.php?page=favorites&paginate=".$str."'>".$str."</a></li>";
                }
                else {
                    echo "<li><a href='index.php?page=favorites&paginate=" . $str . "'>" . $str . "</a></li>";
                }
            }
            ?>
            <ul>
    </div>
    <?php
    }
    ?>

</div>
<div id="addedToCart" class="alert alert-info">
</div>