<?php
require 'header.php';
require 'bdd.php';

// Si l'URL ne contient pas d'id, on redirige sur la page d'accueil

if (empty($_GET['Id'])) {
    header('Location: index.php');
}
// var_dump(filter_input(INPUT_GET, 'Id', FILTER_SANITIZE_SPECIAL_CHARS));
// exit;

$id = filter_input(INPUT_GET, 'Id', FILTER_SANITIZE_SPECIAL_CHARS);

$sqlQuery = 'SELECT * FROM oeuvres where Id = ?';
$oeuvresStatement = $mysqlClient->prepare($sqlQuery);
$oeuvresStatement->execute([$id]);
$oeuvre = $oeuvresStatement->fetch();
// var_dump($oeuvre);
// print_r
// exit;



// Si aucune oeuvre trouvé, on redirige vers la page d'accueil
if (is_null($oeuvre)) {
    header('Location: index.php');
}
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['Url_photo'] ?>" alt="<?= $oeuvre['Titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['Titre'] ?></h1>
        <p class="description"><?= $oeuvre['Artiste'] ?></p>
        <p class="description-complete">
            <?= $oeuvre['Description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>