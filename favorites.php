<?php
    if(!isset($_SESSION['user'])){
        header('Location: index.php');
    }
?>

<div class="container text-center">
    <h1>Favorites</h1>

    <div class="row" id="searchResults">
        <?php
        if(!isset($_REQUEST['paginate']) || !is_numeric($_REQUEST['paginate'])){
            $paginate = 1;
        }
        else{
            $paginate = $_REQUEST['paginate'];
        }
        $onPage = 6;

        $user_id = $_SESSION['user']->id_user;

        $query = "SELECT * FROM news p INNER JOIN favorite f WHERE p.id_news = f.news_id AND f.user_id = $user_id";
        $resultNumber = $conn->query($query);
        $numRows = $resultNumber->rowCount();

        if($resultNumber->rowCount() > 0) {
            $numberPaginate = ceil($numRows / $onPage);


            $firstResult = ($paginate - 1) * $onPage;


            $sql = "SELECT * FROM favorite f INNER JOIN news p ON f.news_id = p.id_news WHERE f.news_id = p.id_news AND f.user_id = $user_id  ORDER BY id_favorite DESC LIMIT " . $firstResult . ',' . $onPage;

            $results = $conn->query($sql)->fetchAll();

            foreach ($results as $r):

                $createdTimestamp = $r->created_at;

                $createdAt = date("H:i | d M Y", $createdTimestamp);
                ?>
                <div class='row space-bottom news-post' id="news-post<?= $r->id_news; ?>">
                    <div class='col-md-6'>
                        <a class="image-hover" href='?page=3&news=<?= $r->id_news; ?>'><img class='img-responsive'
                                                                                            src='<?= $r->image_url; ?>'
                                                                                            alt='<?= $r->name; ?>'/></a>
                    </div>
                    <div class='col-md-6 text-left'>
                        <a href='?page=3&news=<?= $r->id_news; ?>'><h4><?= $r->name; ?></h4></a>
                        <p>
                            <small><?= $createdAt ?></small>
                        </p>
                        <?php if (isset($_SESSION['user'])): ?>
                            <button data-id="<?= $r->id_news; ?>" name="removeFavorites"
                                    class='btn btn-sm btn-primary rem-fav'><span
                                        class="glyphicon glyphicon-remove"></span></button>
                        <?php endif; ?>
                        <p class="top10"><?= $r->excerpt; ?></p>
                    </div>
                </div>
                <div class="clearfix"></div>

            <?php
            endforeach;
            ?>

            <?php
        }
        else{
            echo "<h3 class='fav-title'>It makes us sad that you don't like our news :(</h3>";
            echo "<h3 class='fav-title'>Add something to your favorites <3</h3>";
        }
    ?>
    </div>
</div>
<div id="addedToFav" class="alert alert-info">
</div>
