<?php

@session_start();
include "../php/connection.php";

if(isset($_POST['id'])){

    $news_id = $_POST['id'];
    $user_id = $_SESSION['user']->id_user;

    $q = "SELECT * FROM favorite WHERE news_id = $news_id AND user_id = $user_id";
    $resultNumber = $conn->query($q);

    if($resultNumber->rowCount() == 0) {

        try {

            $query = "INSERT INTO favorite VALUES(NULL, :news_id, :user_id)";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":news_id", $news_id);


            $stmt->bindParam(":user_id", $user_id);

            $added = $stmt->execute();

            if ($added) {
                echo "You did it!";
            }

        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    else{
        echo "You already have it in your favorites!";
    }


}