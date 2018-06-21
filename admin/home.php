<?php
if ($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
}
//comments
$sql = "SELECT count(*) FROM comment";

$result = $conn->prepare($sql);
$result->execute();
$comments = $result->fetchColumn();

//posts
$sql = "SELECT count(*) FROM news";

$result = $conn->prepare($sql);
$result->execute();
$news = $result->fetchColumn();
?>
<div class="col-sm-4">
    <div class="well well-lg">
        <h4><span class="glyphicon glyphicon-comment"></span> Total number of comments: <?= $comments; ?></h4>
    </div>

</div>

<div class="col-sm-4">
    <div class="well well-lg">
        <h4><span class="glyphicon glyphicon-comment"></span> Total number of news: <?= $news; ?></h4>
    </div>
</div>