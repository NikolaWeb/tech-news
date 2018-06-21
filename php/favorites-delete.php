<?php
session_start();
	include "connection.php";
	if(isset($_POST['id'])){

        $id = $_POST['id'];
        $user_id = $_SESSION['user']->id_user;


        $stmt=$conn->prepare("DELETE FROM favorite WHERE news_id = :id AND user_id = :user_id");
        $stmt->bindparam(":id",$id);
        $stmt->bindparam(":user_id",$user_id);
        try{
            $stmt->execute();

        }
        catch(PDOException $e){
            $_SESSION['greske']=$e->getmessage();

        }
    }
    else{
        echo "Something went wrong";
    }
