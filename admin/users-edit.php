<?php
if(isset($_REQUEST['page'])&& isset($_REQUEST['item'])) {
    if (is_numeric($_REQUEST['item'])) {
        $item = trim($_REQUEST['item']);

        $query = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.id_role WHERE id_user = $item";
        $result = $conn->query($query);
        if ($result->rowCount() == 0) {
            echo "There are no items!";
        } else {

            $r = $result->fetch();
            $role_id = $r->role_id;
            ?>
            <div class="col-sm-9">

                <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-update.php' ?>"
                      enctype="multipart/form-data">

                    <input type="hidden" name="id_user" value="<?= $r->id_user; ?>"/>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?= $r->username ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" value="" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role">
                            <option value="<?= $role_id; ?>"><?= $r->role_name; ?></option>
                            <?php
                            $q = "SELECT * FROM role";
                            $results = $conn->query($q)->fetchAll();

                            foreach ($results as $res):
                                if ($res->id_role != $role_id):
                                    ?>
                                    <option value="<?= $res->id_role; ?>"><?= $res->role_name; ?></option>
                                <?php
                                endif;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Full name</label>
                        <input type="text" id="fullname" name="fullname" value="<?= $r->full_name; ?>" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?= $r->email; ?>" class="form-control"/>
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