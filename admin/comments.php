<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
?>
<form method="POST" action="">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Content</th>
            <th>User</th>
            <th>News</th>
            <th>Created</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $q = "SELECT *, c.created_at AS cca FROM comment c INNER JOIN user u ON c.user_id = u.id_user INNER JOIN news n ON c.news_id = n.id_news ORDER BY id_comment DESC";
        $result = $conn->query($q);
        foreach($result as $r):

            $createdTimestamp = $r->cca;

            $createdAt = date("H:i | d M Y",  $createdTimestamp);

        ?>
            <tr id="item-row<?= $r->id_comment; ?>">
                <td> <?= $r->id_comment; ?> </td>
                <td> <?= $r->content; ?> </td>
                <td> <?= $r->username; ?> </td>
                <td> <?= $r->name; ?> </td>
                <td> <?= $createdAt; ?> </td>
                <td><a href="?page=comments&item=<?= $r->id_comment; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
                <td><a class="del-item" data-id="<?= $r->id_comment; ?>" href="#"><i class="glyphicon glyphicon-trash" ></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>