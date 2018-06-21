<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
if(isset($_REQUEST['page'])&& isset($_REQUEST['item'])) {
    if (is_numeric($_REQUEST['item'])) {
        $item = trim($_REQUEST['item']);

        $query = "SELECT * FROM comment c INNER JOIN user u ON c.user_id = u.id_user INNER JOIN news n ON c.news_id = n.id_news WHERE id_comment = $item";
        $result = $conn->query($query);
        if ($result->rowCount() == 0) {
            echo "There are no items!";
        } else {

            $r = $result->fetch();
            $user_id = $r->user_id;
            $news_id = $r->news_id;
            ?>
            <div class="col-sm-9">

                <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-update.php' ?>">

                    <input type="hidden" name="id_comment" value="<?= $r->id_comment; ?>"/>

                    <div class="form-group">
                        <label for="content">Content</label>
                        <input type="text"  name="content" value="<?= $r->content; ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Users</label>
                        <select class="form-control" name="users">
                            <option value="<?= $user_id; ?>"><?= $r->username; ?></option>
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
                            <option value="<?= $news_id; ?>"><?= $r->name; ?></option>
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