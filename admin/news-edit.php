<?php
if(isset($_REQUEST['page'])&& isset($_REQUEST['item'])) {
    if (is_numeric($_REQUEST['item'])) {
        $item = trim($_REQUEST['item']);

        $query = "SELECT * FROM news WHERE id_news = $item";
        $result = $conn->query($query);
        if ($result->rowCount() == 0) {
            echo "There are no items!";
        } else {

            $r = $result->fetch();
            ?>
            <div class="col-sm-9">

                <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-update.php' ?>" enctype="multipart/form-data">

                    <input type="hidden" name="id_news" value="<?= $r->id_news; ?>"/>
                    <div class="form-group">
                        <img style="max-width:400px;" src="<?= $r->image_url; ?>" alt="Responsive image" class="img-responsive img-panel-slider"/>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" value="<?= $r->name; ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="btn btn-default">
                            Browse images <input class="myImg" name="slika" id="uploadImage" type="file" hidden>
                        </label> <span class="text-warning">Recommended ratio is 16:9</span>
                    </div>
                    <div class="form-group">
                        <label for="desc">Content</label>
                        <textarea id="content" name="desc" class="form-control"><?= $r->description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <input type="text" id="excerpt" name="excerpt" value="<?= $r->excerpt; ?>" class="form-control"/>
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
                    unset($_SESSION['success']);
                endif;
                ?>
            </div>
            <?php


        }

    }
}
?>