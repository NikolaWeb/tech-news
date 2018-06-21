<form method="POST" action="">
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Image URL</th>
            <th>ALT</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        $q = "SELECT * FROM slider";
        $result = $conn->query($q);
        foreach($result as $r):
        ?>
        <tr id="item-row<?= $r->id_slider; ?>">
            <td> <?= $r->id_slider; ?> </td>
            <td> <img src="<?= $r->url; ?>" width="130px" alt="<?= $r->alt ?>"/> </td>
            <td> <?= $r->url; ?> </td>
            <td> <?= $r->alt ?> </td>
            <td><a href="?page=slider&item=<?= $r->id_slider; ?>"><i class="glyphicon glyphicon-edit"></i></a></td>
            <td><a class="del-item" data-id="<?= $r->id_slider; ?>" href="#"><i class="glyphicon glyphicon-trash" ></i></a></td>
        </tr>
       <?php endforeach; ?>
    </table>
</form>