<?php
session_start();
include "connection.php";
if(isset($_POST['submit'])){
    $id_news = $_POST['id_news'];
    
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
        header('Location: ../../admin.php?page=news&item='.$id_news);
    }
    else{
        $naziv = time()."_".$ime;
        $putanja = 'images/uploads/'.$naziv;

        if(in_array($tip, $formati)){
            if (move_uploaded_file($tmp_ime, '../../' . $putanja)) {
                $query = "UPDATE news SET name = :title, image_url = :url, description = :description, excerpt = :excerpt WHERE id_news = :id_news";
                $insertSlika = $conn->prepare($query);
                $insertSlika->bindParam(':title', $title);
                $insertSlika->bindParam(':url', $putanja);
                $insertSlika->bindParam(':description', $description);
                $insertSlika->bindParam(':excerpt', $excerpt);
                $insertSlika->bindParam(':id_news', $id_news);

                $insertuj = $insertSlika->execute();
            }
            if($insertuj){
                header('Location: ../../admin.php?page=news&item='.$id_news);
                $_SESSION['success'] = "Post je uspesno azuriran";
            }
        }

        else{
            $q = "UPDATE news SET name = :title, description = :description, excerpt = :excerpt WHERE id_news = :id_news";
            $insert = $conn->prepare($q);
            $insert->bindParam(':title', $title);
            $insert->bindParam(':description', $description);
            $insert->bindParam(':excerpt', $excerpt);
            $insert->bindParam(':id_news', $id_news);

            $insertBez = $insert->execute();
            if($insertBez){
                header('Location: ../../admin.php?page=news&item='.$id_news);
                $_SESSION['success'] = "Post je uspesno azuriran";

            }

        }



    }
    header('Location: ../../admin.php?page=news&item='.$id_news);


}


