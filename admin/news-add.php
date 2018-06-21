<?php
if(isset($_REQUEST['page'])) {
    ?>
    <div class="col-sm-9">

        <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-insert.php' ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="btn btn-default">
                    Browse images <input class="myImg" name="slika" id="uploadImage" type="file" hidden>
                </label> <span class="text-warning">Recommended ratio is 16:9</span>
            </div>
            <div class="form-group">
                <label for="desc">Content</label>
                <textarea id="content" name="desc" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="excerpt">Excerpt</label>
                <input type="text" id="excerpt" name="excerpt" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Add"/>
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
            foreach((array)$_SESSION['errors'] as $err):
            ?>
                <div class="alert alert-danger"><?= $err; ?></div>
            <?php
            endforeach;
            unset($_SESSION['errors']);
        endif;
        ?>
    </div>
    <?php

}
?>