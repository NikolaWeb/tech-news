<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
if(isset($_REQUEST['page'])&& isset($_REQUEST['item'])) {
    if (is_numeric($_REQUEST['item'])) {
        $item = trim($_REQUEST['item']);

        $query = "SELECT * FROM slider s INNER JOIN news n ON news_id = id_news WHERE id_slider = $item";
        $result = $conn->query($query);
        if ($result->rowCount() == 0) {
            echo "There are no items!";
        } else {

            $r = $result->fetch();
            $news_id = $r->news_id;
            ?>
            <div class="col-sm-9">

                <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-update.php' ?>"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id_slider" value="<?= $r->id_slider; ?>"/>

                    <div class="form-group">
                        <img src="<?= $r->url; ?>" alt="Responsive image" class="img-responsive img-panel-slider"/>
                    </div>
                    <div class="form-group">
                        <label for="altTag">Alt</label>
                        <input type="text" id="altTag" name="alt" value="<?= $r->alt; ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="btn btn-default">
                            Browse images <input class="myImg" name="slika" id="uploadImage" type="file" hidden>
                        </label> <span class="text-warning">Recommended size is 880x340px</span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="linked-article">
                            <option value="<?= $news_id; ?>"><?= $r->name; ?></option>
                            <?php
                            $q = "SELECT * FROM news";
                            $results = $conn->query($q)->fetchAll();

                            foreach ($results as $res):
                                if ($res->id_news != $news_id):
                                    ?>
                                    <option value="<?= $res->id_news; ?>"><?= $res->name; ?></option>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="edit_item btn btn-lg btn-primary"
                               value="Confirm editing"/>
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
                    <div class="alert alert-danger">
                        <ul>
                            <?php
                            $errors = $_SESSION['errors'];
                            foreach ($errors as $error):
                                ?>
                                <li><?= $error; ?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </div>
                    <?php
                    unset($_SESSION['errors']);
                endif;
                ?>
            </div>
            <?php


        }

    }
}
?>