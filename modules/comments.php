<div class="row">
    <?php
    $q = "SELECT * FROM comment INNER JOIN user ON user_id = id_user WHERE product_id = :id";
    $stmt = $conn->prepare($q);
    $stmt->bindParam(":id", $idProduct);

    try {
        $res = $stmt->execute();

        if($res){
            $comments = $stmt->fetchAll();
        }
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
    }
    ?>
    <div class="comments-list text-left">
        <?php
        $commentedAt = '';
        foreach($comments as $com):

            $commentedTimestamp = $com->created_at;

            $commentedAt = date("H:i:s | d M Y",  $commentedTimestamp);
            ?>

            <div class="media">
                <p class="pull-right"><small><?= $commentedAt; ?></small></p>

                <div class="media-body">

                    <h4 class="media-heading user_name"><?= $com->username; ?></h4>
                    <?= $com->content; ?>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
</div>
<div class="row space-bottom">
    <?php if(isset($_SESSION['user'])): ?>
    <h2>Leave a comment</h2>
    <form method="POST" action="php/comment-insert.php">
        <div class="form-group">
            <input type="hidden" name="product_id" value="<?= $r->id_product; ?>" />
            <textarea class="space-bottom-2" placeholder="Type something here..." class="form-control" rows="5" id="comment" name="comment"></textarea>
            <input type="submit" name="send" class="btn btn-lg btn-primary btn-block" id="send" value="Send" />
        </div>
    </form>
    <?php else: ?>
    <h2>You need to be signed in to leave a commment!</h2>
    <?php endif; ?>
</div>