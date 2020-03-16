<?php require_once "../../controllers/discs/create.php"; ?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Ajouter un Disque</h1>
        <form enctype="multipart/form-data" method="POST" id="createDisc">
            <input type="hidden" name="crsf_token" value="<?= $_SESSION['crsf_token'] ?>">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="title">Titre</label>
                    <input name="title" id="title" type="text" value="<?= $_POST['title'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["title"] ?? "" ?></span>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <select name="artists" id="artists">
                        <option disabled value="" selected>Veuillez choisir un artiste</option>
                        <?php foreach ($artists as $artist): ?>
                            <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="artists">Artiste</label>
                    <span class="helper-text red-text" id="artistsError"><?= $formErrors["artists"] ?? "" ?></span>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="year">Année</label>
                    <input name="year" id="year" type="text" value="<?= $_POST['year'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["year"] ?? "" ?></span>
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="genre">Genre</label>
                    <input name="genre" id="genre" type="text" value="<?= $_POST['genre'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["genre"] ?? "" ?></span>
                </div>
            </div>
            <!-- Fifth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="label">Label</label>
                    <input name="label" id="label" type="text" value="<?= $_POST['label'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["label"] ?? "" ?></span>
                </div>
            </div>
            <!-- Sixth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="price">Prix</label>
                    <input name="price" id="price" type="text" value="<?= $_POST['price'] ?? '' ?>">
                    <span class="helper-text red-text"><?= $formErrors["price"] ?? "" ?></span>
                </div>
            </div>
            <!-- Seventh Row -->
            <div class="row">
                <div class="col s12 file-field input-field">
                    <div class="btn deep-orange lighten-1">
                        <span>Image</span>
                        <input name="image" id="image" type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <label for="filePath"></label>
                        <input class="file-path" name="filePath" id="filePath" type="text">
                        <span class="helper-text red-text"><?= $formErrors["image"] ?? "" ?></span>
                        <span class="helper-text red-text"><?= $formErrors["filePath"] ?? "" ?></span>
                    </div>
                </div>
            </div>
            <!-- Eigth row -->
            <div class="row">
                <div class="col s12">
                    <img
                        alt="Image de prévisualisation"
                        class="responsive-img"
                        id="imagePreview"
                        src="https://via.placeholder.com/728x190?text=Prévisualisation de la photo"
                    >
                </div>
            </div>
            <!-- Ninth row -->
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
<script src="../../assets/js/discs/form.js"></script>
</body>
</html>
