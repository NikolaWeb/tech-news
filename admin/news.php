<form method="POST" action="">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Image</th>
            <th>Image URL</th>
            <th>Excerpt</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $q = "SELECT * FROM News";
        $result = $conn->query($q);
        foreach($result as $r):
            ?>
            <tr id="item-row<?= $r->id_news; ?>">
                <td> <?= $r->id_news; ?> </td>
                <td><?= $r->name; ?></td>
                <td> <img src="<?= $r->image_url; ?>" width="130px" alt="<?= $r->name ?>"/> </td>
                <td> <?= $r->image_url; ?> </td>
                <td> <?= $r->excerpt ?> </td>
                <td><a href="?page=slider&item=<?= $r->id_slider; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
                <td><a class="del-item" data-id="<?= $r->id_slider; ?>" href="#"><i class="glyphicon glyphicon-trash" ></i></a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</form>