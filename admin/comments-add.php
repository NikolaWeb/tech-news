<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
if(isset($_REQUEST['page'])) {
    ?>
    <div class="col-sm-9">

        <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-insert.php' ?>">

            <div class="form-group">
                <label for="content">Content</label>
                <input type="text"  name="content" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Users</label>
                <select class="form-control" name="users">
                    <option value="0">Choose...</option>
                    <?php
                    $q = "SELECT * FROM user";
                    $results = $conn->query($q)->fetchAll();

                    foreach ($results as $res):

                        ?>
                        <option value="<?= $res->id_user; ?>"><?= $res->username; ?></option>
                    <?php

                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>News</label>
                <select class="form-control" name="news">
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