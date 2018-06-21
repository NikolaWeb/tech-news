<?php
if(isset($_REQUEST['page'])) {
    ?>
    <div class="col-sm-9">

        <form class="order" method="POST" action="<?= 'admin/php/' . $_GET['page'] . '-insert.php' ?>" enctype="multipart/form-data">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role">
                    <option value="0">Choose...</option>
                    <?php
                    $q = "SELECT * FROM role";
                    $results = $conn->query($q)->fetchAll();

                    foreach ($results as $res):

                        ?>
                        <option value="<?= $res->id_role; ?>"><?= $res->role_name; ?></option>
                    <?php

                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="fullname">Full name</label>
                <input type="text" id="fullname" name="fullname" value="" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="" class="form-control"/>
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