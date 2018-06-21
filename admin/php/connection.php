<?php
DEFINE("SERVER","localhost");
DEFINE("USER","root");
DEFINE("PASS","");
DEFINE("DATABASE","novo");

$conn = mysqli_connect(SERVER, USER, PASS, DATABASE) OR die('Database connection error!:\n'.mysqli_connect_error());


try {
    // Kreiranje konekcije sa bazom

    $conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USER, PASS);

    // Ukljucivanje Error reporting
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Promena DEFAULT moda vracanja podataka iz baze - objekti
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>
