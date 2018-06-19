<?php

@session_start();
include "php/connection.php";

if(isset($_POST['send'])){

    $comment = $_POST['comment'];
    $product_id = $_POST['product_id'];

    $errors = [];

    $reComment = "/^[\w\s]{1,255}$/";

    if(!preg_match($reComment, $comment)){
        $errors[] = "Your comment is not in a valid format.";
    }


    if(count($errors) == 0){

        try{

            $query = "INSERT INTO comment VALUES(NULL, :comment, :user_id, :product_id, :created_at)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":comment", $comment);

            $user_id = $_SESSION['user']->id_user;
            $stmt->bindParam(":user_id", $user_id);

            $stmt->bindParam(":product_id", $product_id);

            $created_at = time();
            $stmt->bindParam(":created_at", $created_at);


            $added = $stmt->execute();

            if($added){
                echo "You did it!";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }

    }
    else {

        echo "<ol>";

        foreach($errors as $error){
            echo "<li> $error </li>";
        }

        echo "</ol>";
    }
}