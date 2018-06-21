<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $excerpt = $_POST['excerpt'];

    $slika = $_FILES['slika'];
    $tip = $slika['type'];
    $ime = $slika['name'];
    $tmp_ime = $slika['tmp_name'];
    $velicina = $slika['size'];
    $formati = array('image/jpg', 'image/jpeg', 'image/png');

    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if($title == ''){
        $greske[] = 'Nedostaje naslov!';
    }
    if($description == ''){
        $greske[] = 'Nedostaje sadrzaj posta!';
    }
    if($excerpt == ''){
        $greske[] = 'Nedostaje kratak opis posta!';
    }
    if($velicina > 4500000){
        $greske[] = 'Slika je prevelika!';
    }
    if($ime == 'slika'){
        $greske[] = 'Neispravno ime!';
    }
    if(count($greske)>0){
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=news-add');
    }
    else{
        $naziv = time()."_".$ime;
        $putanja = 'images/uploads/'.$naziv;

        if(in_array($tip, $formati)){
            if (move_uploaded_file($tmp_ime, '../../' . $putanja)) {
                $query = "INSERT INTO news VALUES(NULL, :title, :url, :description, :excerpt, :created)";
                $insertSlika = $conn->prepare($query);
                $insertSlika->bindParam(':title', $title);
                $insertSlika->bindParam(':url', $putanja);
                $insertSlika->bindParam(':description', $description);
                $insertSlika->bindParam(':excerpt', $excerpt);
                $insertSlika->bindParam(':created', $timestamp);

                $insertuj = $insertSlika->execute();
            }
            if($insertuj){
                header('Location: ../../admin.php?page=news-add');
                $_SESSION['success'] = "Post je uspesno dodat";
            }
        }

        else{
            $_SESSION['errors'] = "Morate izabrati sliku!";

        }



    }
    header('Location: ../../admin.php?page=news-add');


}


