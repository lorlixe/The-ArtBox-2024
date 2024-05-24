<?php
require 'bdd.php';

$titre = $_POST["titre"];
$description = $_POST["description"];
$artiste = $_POST["artiste"];
$image = $_POST["image"];

if (
    empty($titre) || empty($description) || empty($artiste) || empty($image) || strlen($description) < 3 || !filter_var($image, FILTER_VALIDATE_URL)
) {

    header('Location: ajouter.php');
} else {
    try {
        //On insère les données reçues
        $sqlQuery = "INSERT INTO oeuvres(Titre, Description, Artiste, Url_photo)
        VALUES ( :Titre, :Description, :Artiste, :Url_photo )";
        $oeuvre = $mysqlClient->prepare($sqlQuery);
        $oeuvre->bindParam(':Titre', $titre);
        $oeuvre->bindParam(':Description', $description);
        $oeuvre->bindParam(':Artiste', $artiste);
        $oeuvre->bindParam(':Url_photo', $image);
        $oeuvre->execute();
        header('Location: oeuvre.php?Id=' . $mysqlClient->lastInsertId());
    } catch (PDOException $e) {
        echo 'Impossible de traiter les données. Erreur : ' . $e->getMessage();
    }
}
