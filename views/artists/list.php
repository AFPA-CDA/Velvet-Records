<?php require_once "../../controllers/artists/list.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <h1 class="center-align">Liste des artistes (<?= count($artists) ?>)</h1>
    <div class="row section">
        <!-- For each discs it creates a card with all the informations about the disc -->
        <?php foreach ($artists as $artist): ?>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-content">
                        <?php if ($_SESSION["connected"]): ?>
                            <a href="update.php?artist_id=<?= $artist->artist_id ?>">
                                <span class="badge"><i class="material-icons">edit</i></span>
                            </a>
                        <?php endif; ?>
                        <div class="center-align row">
                            <span class="card-title">
                                <b><?= $artist->artist_name ?></b>
                            </span>
                        </div>
                    </div>
                    <div class="card-action" id="artistButtons">
                        <a
                            class="btn deep-orange lighten-1 waves-effect waves-light"
                            href="../../views/artists/details.php?artist_id=<?= $artist->artist_id ?>"
                        >
                            Détails
                        </a>
                        <?php if ($_SESSION["connected"]): ?>
                            <a
                                class="btn red waves-effect waves-light"
                                data-id="<?= $artist->artist_id ?>"
                                data-token="<?= $_SESSION['crsf_token'] ?>"
                                href="../../controllers/artists/delete.php?artist_id=<?= $artist->artist_id ?>&crsf_token=<?= $_SESSION['crsf_token'] ?>"
                                id="deleteButton<?= $artist->artist_id ?>"
                            >
                                Supprimer
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($_SESSION["connected"]): ?>
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large deep-orange lighten-1" href="create.php">
                <i class="material-icons">add</i>
            </a>
        </div>
    <?php endif; ?>
</main>

<?php include_once "../templates/footer.php" ?>
<script src="../../assets/js/vendors/sweetalert2.min.js"></script>
<script src="../../assets/js/artists/delete.js"></script>
</body>
</html>
