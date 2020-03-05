<?php require_once "../../controllers/auth/login.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Se connecter</h1>
        <form method="POST">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="email">
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="password">Mot de passe</label>
                    <input name="password" id="password" type="password">
                </div>
            </div>
            <!-- Third Row -->
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
