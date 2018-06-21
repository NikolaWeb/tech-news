<?php

include "../../php/connection.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];


    $stmt=$conn->prepare("DELETE FROM slider WHERE id_slider = :id");
    $stmt->bindparam(":id",$id);
    try{
        $stmt->execute();
		echo "uspeh";
    }
    catch(PDOException $e){
        $_SESSION['greske']=$e->getmessage();

    }
}
else{
    echo "Something went wrong";
}