<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $role_id = $_POST['role'];

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if($role_id == 0){
        $greske[] = "Morate izabrati ulogu korisnika!";
    }
    if(count($greske)>0){
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=users&item='.$id_user);
    }
    else{

        if($password != '') {

            $query = "UPDATE user SET username = :username, password = :password, role_id = :role_id, full_name = :fullname, email = :email WHERE id_user = :id_user";
            $insert = $conn->prepare($query);
            $insert->bindParam(':username', $username);
            $insert->bindParam(':password', md5($password));
            $insert->bindParam(':role_id', $role_id);
            $insert->bindParam(':fullname', $fullname);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':id_user', $id_user);

            $insertuj = $insert->execute();

            if ($insertuj) {
                header('Location: ../../admin.php?page=users&item=' . $id_user);
                $_SESSION['success'] = "Korisnik je uspesno azuriran";
            }
        }

        else{
            $q = "UPDATE user SET username = :username, role_id = :role_id, full_name = :fullname, email = :email WHERE id_user = :id_user";
            $ins = $conn->prepare($q);
            $ins->bindParam(':username', $username);
            $ins->bindParam(':role_id', $role_id);
            $ins->bindParam(':fullname', $fullname);
            $ins->bindParam(':email', $email);
            $ins->bindParam(':id_user', $id_user);


            $insertBez = $ins->execute();
            if($insertBez){
                header('Location: ../../admin.php?page=users&item='.$id_user);
                $_SESSION['success'] = "Korisnik je uspesno azuriran";

            }

        }



    }
    header('Location: ../../admin.php?page=users&item='.$id_user);


}


