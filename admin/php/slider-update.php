<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $id_slider = $_POST['id_slider'];
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
        header('Location: ../../admin.php?page=slider&item='.$id_slider);
    }
    else{
        $naziv = time()."_".$ime;
        $putanja = 'images/uploads/'.$naziv;

        if(in_array($tip, $formati)){
            if (move_uploaded_file($tmp_ime, '../../' . $putanja)) {
                $query = "UPDATE slider SET url = :url, alt = :alt, news_id = :news_id WHERE id_slider = :id_slider";
                $insertSlika = $conn->prepare($query);
                $insertSlika->bindParam(':url', $putanja);
                $insertSlika->bindParam(':alt', $alt);
                $insertSlika->bindParam(':news_id', $news_id);
                $insertSlika->bindParam(':id_slider', $id_slider);

                $insertuj = $insertSlika->execute();
            }
            if($insertuj){
                header('Location: ../../admin.php?page=slider&item='.$id_slider);
                $_SESSION['success'] = "Slide je uspesno azuriran";
            }
        }

        else{
            $q = "UPDATE slider SET alt = :alt, news_id = :news_id WHERE id_slider = :id_slider";
            $insert = $conn->prepare($q);
            $insert->bindParam(':alt', $alt);
            $insert->bindParam(':news_id', $news_id);
            $insert->bindParam(':id_slider', $id_slider);

            $insertBez = $insert->execute();
            if($insertBez){
                header('Location: ../../admin.php?page=slider&item='.$id_slider);
                $_SESSION['success'] = "Slide je uspesno azuriran";

            }

        }



    }
    header('Location: ../../admin.php?page=slider&item=6');


}


