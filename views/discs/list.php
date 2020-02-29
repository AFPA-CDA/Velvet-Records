<?php
require_once "../../controllers/discs/list.php";
?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <h1 class="center-align">Liste des disques (<?= count($discs) ?>)</h1>
    <div class="row section">
        <!-- For each discs it creates a card with all the informations about the disc -->
        <?php foreach ($discs as $disc): ?>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img
                            alt="Image du disque"
                            class="responsive-img materialboxed"
                            src="../../assets/img/<?= $disc->disc_picture ?>"
                        >
                        <span class="card-title"><?= $disc->disc_title ?></span>
                    </div>
                    <div class="card-content">
                        <div class="center-align row">
                            <p class="flow-text" id="artistName"><?= $disc->artist_name ?></p>
                            <div class="col s12">
                                <p><b>Année</b>: <?= $disc->disc_year ?></p>
                                <p><b>Label</b>: <?= $disc->disc_label ?></p>
                                <p><b>Genre</b>: <?= $disc->disc_genre ?></p>
                                <p><b>Prix</b>: <?= $disc->disc_price ?>€</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <a
                            class="btn deep-orange lighten-1"
                            id="detailsButton"
                            href="details.php?disc_id=<?= $disc->disc_id ?>"
                        >
                            Détails
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="fixed-action-btn">
        <a class="btn-floating btn-large deep-orange lighten-1" href="create.php">
            <i class="material-icons">add</i>
        </a>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
</body>
</html>
