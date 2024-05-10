<?php
require 'header.php';
require 'bdd.php';
$sqlQuery = 'SELECT * FROM oeuvres';
$oeuvresStatement = $mysqlClient->prepare($sqlQuery);
$oeuvresStatement->execute();
$oeuvres = $oeuvresStatement->fetchAll();

?>



<div id="liste-oeuvres">
    <?php foreach ($oeuvres as $oeuvre) : ?>
        <article class="oeuvre">
            <a href="oeuvre.php?Id=<?= $oeuvre['Id'] ?>">
                <img src="<?= $oeuvre['Url_photo'] ?>" alt="<?= $oeuvre['Titre'] ?>">
                <h2><?= $oeuvre['Titre'] ?></h2>
                <p class="Description"><?= $oeuvre['Artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>