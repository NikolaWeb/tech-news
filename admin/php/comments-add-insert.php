<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])) {
    $content = $_POST['content'];
    $user_id = $_POST['users'];
    $news_id = $_POST['news'];

    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if ($user_id == 0) {
        $greske[] = "Morate izabrati korisnika!";
    }
    if ($news_id == 0) {
        $greske[] = "Morate izabrati vest!";
    }

    if (count($greske) > 0) {
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=comments-add');
    }
    else {

        $query = "INSERT INTO comment VALUES(NULL, :content, :user_id, :news_id, :created)";
        $insert = $conn->prepare($query);
        $insert->bindParam(':content', $content);
        $insert->bindParam(':user_id', $user_id);
        $insert->bindParam(':news_id', $news_id);
        $insert->bindParam(':created', $timestamp);

        $insertuj = $insert->execute();

        if ($insertuj) {
            header('Location: ../../admin.php?page=comments-add');
            $_SESSION['success'] = "Korisnik je uspesno dodat!";
        } else {
            $_SESSION['errors'] = "Nije uspelo dodavanje!";

        }
    }

    header('Location: ../../admin.php?page=comments-add');

}


