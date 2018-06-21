<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $id_comment = $_POST['id_comment'];
    $content = $_POST['content'];
    $user_id = $_POST['users'];
    $news_id = $_POST['news'];

    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if($user_id == 0){
        $greske[] = "Morate izabrati korisnika!";
    }
    if($news_id == 0){
        $greske[] = "Morate izabrati vest!";
    }
    if(count($greske)>0){
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=comments&item='.$id_comment);
    }
    else {

        $query = "UPDATE comment SET content = :content, user_id = :user_id, news_id = :news_id WHERE id_comment = :id_comment";
        $insert = $conn->prepare($query);
        $insert->bindParam(':content', $content);
        $insert->bindParam(':user_id', $user_id);
        $insert->bindParam(':news_id', $news_id);
        $insert->bindParam(':id_comment', $id_comment);

        $insertuj = $insert->execute();

        if ($insertuj) {
            header('Location: ../../admin.php?page=comments&item=' . $id_comment);
            $_SESSION['success'] = "Korisnik je uspesno azuriran";
        }

    }

    header('Location: ../../admin.php?page=comments&item='.$id_comment);

}


