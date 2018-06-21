<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];


    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if ($role_id == 0) {
        $greske[] = "Morate izabrati ulogu!";
    }

    if (count($greske) > 0) {
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=users-add');
    }
    else {

        $query = "INSERT INTO user VALUES(NULL, :username, :password, :role_id, :fullname, :email)";
        $insert = $conn->prepare($query);
        $insert->bindParam(':username', $username);
        $insert->bindParam(':password', md5($password));
        $insert->bindParam(':role_id', $role_id);
        $insert->bindParam(':fullname', $fullname);
        $insert->bindParam(':email', $email);

        $insertuj = $insert->execute();

        if ($insertuj) {
            header('Location: ../../admin.php?page=users-add');
            $_SESSION['success'] = "Korisnik je uspesno dodat!";
        } else {
            $_SESSION['errors'] = "Nije uspelo dodavanje!";

        }
    }

    header('Location: ../../admin.php?page=users-add');

}


