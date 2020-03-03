<?php require_once "../../controllers/artists/create.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Ajouter un Disque</h1>
        <form method="POST">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="name">Titre</label>
                    <input name="name" id="name" type="text" value="<?= $_POST['name'] ?? '' ?>">
                    <span class="helper-text red-text">
                        <?= isset($formErrors["name"]) ? $formErrors["name"] : "" ?>
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
                    <button class="btn red waves-effect waves-light" type="reset">
                        Annuler
                        <i class="material-icons right">cancel</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
</body>
</html>
