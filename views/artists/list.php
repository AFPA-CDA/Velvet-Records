<?php require_once "../../controllers/artists/list.php"; ?>

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
