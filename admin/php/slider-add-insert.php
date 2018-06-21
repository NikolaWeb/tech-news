<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $alt = $_POST['alt'];
    $news_id = $_POST['linked-article'];

    $slika = $_FILES['slika'];
    $tip = $slika['type'];
    $ime = $slika['name'];
    $tmp_ime = $slika['tmp_name'];
    $velicina = $slika['size'];
    $formati = array('image/jpg', 'image/jpeg', 'image/png');

    $timestamp = time();

    $vremeKreiranja = date("Y-m-d H:i:s", $timestamp);

    $greske = [];

    if($news_id == 0){
        $greske[] = "Mora biti izabran povezani clanak";
    }
    if($velicina > 4500000){
        $greske[] = 'Slika je prevelika!';
    }
    if($ime == 'slika'){
        $greske[] = 'Neispravno ime!';
    }
    if(count($greske)>0){
        $_SESSION['errors'] = $greske;
        header('Location: ../../admin.php?page=slider-add');
    }
    else{
        $naziv = time()."_".$ime;
        $putanja = 'images/uploads/'.$naziv;

        if(in_array($tip, $formati)){
            if (move_uploaded_file($tmp_ime, '../../' . $putanja)) {
                $query = "INSERT INTO slider VALUES(NULL, :url, :alt, :news_id)";
                $insertSlika = $conn->prepare($query);
                $insertSlika->bindParam(':url', $putanja);
                $insertSlika->bindParam(':alt', $alt);
                $insertSlika->bindParam(':news_id', $news_id);

                $insertuj = $insertSlika->execute();
            }
            if($insertuj){
                header('Location: ../../admin.php?page=slider-add');
                $_SESSION['success'] = "Slide je uspesno dodat!";
            }
        }

        else{
            $_SESSION['errors'] = "Morate izabrati sliku!";

        }



    }
    header('Location: ../../admin.php?page=slider-add');


}


