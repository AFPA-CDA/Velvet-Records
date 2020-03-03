<?php require_once "../../controllers/artists/details.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <h1 class="center-align">Nombre de disques: <?= count($artistDiscsList) ?></h1>
    <div class="row section">
        <!-- For each discs it creates a card with all the informations about the disc -->
        <?php foreach ($artistDiscsList as $disc): ?>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img
                            alt="Image du disque"
                            class="responsive-img"
                            src="../../assets/img/<?= $disc->disc_picture ?>"
                        >
                    </div>
                    <div class="card-content">
                        <div class="center-align row">
                            <p class="flow-text" id="artistName">
                                <?= $disc->artist_name ?> (<?= $disc->disc_title ?>)
                            </p>
                            <div class="col s12">
                                <p><b>Année</b>: <?= $disc->disc_year ?></p>
                                <p><b>Label</b>: <?= $disc->disc_label ?></p>
                                <p><b>Genre</b>: <?= $disc->disc_genre ?></p>
                                <p><b>Prix</b>: <?= $disc->disc_price ?>€</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
</body>
</html>
