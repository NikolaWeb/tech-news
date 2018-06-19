<head>
    <title>Tech-World |
        <?php
        if($pageid == 1){
            echo "Get updated!";
        }
        else{
            echo $pageinfo->name;
        }
        ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="shortcut icon" href="images/favicon.png" />
    <meta name="author" content="Nikola Reljić">
    <?php
    $q = "SELECT * FROM menu WHERE id_menu=".$pageid;
    $stmt = $conn->prepare($q);
    $stmt->execute();
    $r = $stmt->fetch();
    ?>
    <meta name="keywords" content="<?php echo $r->keywords; ?>">
    <meta name="description" content="<?php echo $r->description; ?>">

</head>