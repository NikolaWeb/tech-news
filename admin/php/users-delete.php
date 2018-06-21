<?php

include "connection.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];


    $stmt=$conn->prepare("DELETE FROM user WHERE id_user = :id");
    $stmt->bindparam(":id",$id);
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