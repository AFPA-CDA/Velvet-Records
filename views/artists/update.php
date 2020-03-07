<?php require_once "../../controllers/artists/update.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Mettre à jour un Artiste</h1>
        <form method="POST" id="createArtist">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="name">Nom de l'artiste</label>
                    <input name="name" id="name" type="text" value="<?= $_POST['name'] ?? '' ?>">
                    <span class="helper-text red-text">
                        <?= $formErrors["name"] ?? "" ?>
                    </span>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <button class="btn deep-orange lighten-1 waves-effect waves-light" type="submit">
                        Envoyer
                        <i class="material-icons right">send</i>
                    </button>
                    <a class="btn red waves-effect waves-light" href="list.php">
                        Retour
                        <i class="material-icons right">undo</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
<script src="../../assets/js/vendors/sweetalert2.min.js"></script>
<script src="../../assets/js/artists/form.js"></script>
</body>
</html>
