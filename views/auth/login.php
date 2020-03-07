<?php require_once "../../controllers/auth/login.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Se connecter</h1>
        <form method="POST" id="authLogin">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="email">Email</label>
                    <input name="email" id="email" type="text" value="<?= $_POST['email'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["email"] ?? "" ?></span>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="password">Mot de passe</label>
                    <input name="password" id="password" type="password">
                    <span class="helper-text red-text"><?= $formErrors["password"] ?? "" ?></span>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <button class="btn deep-orange lighten-1 waves-effect waves-light" type="submit">
                        Envoyer
                        <i class="material-icons right">send</i>
                    </button>
                    <a class="btn red waves-effect waves-light" href="../../index.php">
                        Retour
                        <i class="material-icons right">undo</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
<script src="../../assets/js/auth/form.js"></script>
</body>
</html>
