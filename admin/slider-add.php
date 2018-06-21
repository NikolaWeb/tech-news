<?php
if(isset($_REQUEST['page'])) {

    $query = "SELECT * FROM slider s INNER JOIN news n ON news_id = id_news";
    $result = $conn->query($query);
    if ($result->rowCount() == 0) {
        echo "There are no items!";
    } else {

        $r = $result->fetch();
        $news_id = $r->news_id;
        ?>
        <div class="col-sm-9">

            <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-insert.php' ?>"
                  enctype="multipart/form-data">

                <div class="form-group">
                    <label for="altTag">Alt</label>
                    <input type="text" id="altTag" name="alt" value="" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="btn btn-default">
                        Browse images <input class="myImg" name="slika" id="uploadImage" type="file" hidden>
                    </label> <span class="text-warning">Recommended size is 880x340px</span>
                </div>
                <div class="form-group">
                    <select class="form-control" name="linked-article">
                        <option value="0">Choose...</option>
                        <?php
                        $q = "SELECT * FROM news";
                        $results = $conn->query($q)->fetchAll();

                        foreach ($results as $res):

                            ?>
                            <option value="<?= $res->id_news; ?>"><?= $res->name; ?></option>
                        <?php

                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Confirm editing"/>
                </div>
            </form>
            <?php
            if (isset($_SESSION['success'])):
                ?>
                <div class="alert alert-success"><?= $_SESSION['success']; ?></div>

                <?php
                unset($_SESSION['success']);
            endif;
            if (isset($_SESSION['errors'])):
                ?>
                <div class="alert alert-danger">Neuspesno azuriran slide!</div>
                <?php
                unset($_SESSION['success']);
            endif;
            ?>
        </div>
        <?php


    }

}
?>