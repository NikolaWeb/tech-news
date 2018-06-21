<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
?>
<form method="POST" action="">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $q = "SELECT * FROM user u INNER JOIN role r ON u.role_id = r.id_role";
        $result = $conn->query($q);
        foreach($result as $r):
            ?>
            <tr id="item-row<?= $r->id_user; ?>">
                <td> <?= $r->id_user; ?> </td>
                <td> <?= $r->username; ?> </td>
                <td> <?= $r->role_name; ?> </td>
                <td> <?= $r->full_name; ?> </td>
                <td> <?= $r->email; ?> </td>
                <td><a href="?page=users&item=<?= $r->id_user; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
                <td><a class="del-item" data-id="<?= $r->id_user; ?>" href="#"><i class="glyphicon glyphicon-trash" ></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>