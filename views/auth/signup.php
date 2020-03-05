<?php require_once "../../controllers/auth/signup.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Créer un compte</h1>
        <form method="POST">
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
                    <label for="lastname">Nom</label>
                    <input name="lastname" id="lastname" type="text" value="<?= $_POST['lastname'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["lastname"] ?? "" ?></span>
                </div>
            </div>
            <!-- Thrid Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="firstname">Prénom</label>
                    <input name="firstname" id="firstname" type="text" value="<?= $_POST['firstname'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["firstname"] ?? "" ?></span>
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="password">Mot de passe</label>
                    <input name="password" id="password" type="password">
                    <span class="helper-text red-text"><?= $formErrors["password"] ?? "" ?></span>
                </div>
            </div>
            <!-- Fifth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="confirmation">Confirmation du mot de passe</label>
                    <input name="confirmation" id="confirmation" type="password">
                    <span class="helper-text red-text"><?= $formErrors["confirmation"] ?? "" ?></span>
                </div>
            </div>
            <!-- Sixth row -->
            <div class="row">
                <div class="col s12 input-field">
                    <button class="btn deep-orange lighten-1 waves-effect waves-light" type="submit">
                        S'inscire
                        <i class="material-icons right">send</i>
                    </button>
                    <a class="btn red waves-effect waves-light" href="../../index.php">
                        Retour
                        <i class="material-icons right">cancel</i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
<!-- TODO: Create JS for thoses forms -->
<!--<script src="../../assets/js/vendors/sweetalert2.min.js"></script>
<script src="../../assets/js/discs/form.js"></script>-->
</body>
</html>
