<?php
require_once "../../models/connection.php";
require_once "../../controllers/discs/create.php";
?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Ajouter un Disque</h1>
        <form action="../../controllers/discs/create.php" enctype="multipart/form-data" method="post">
            <!-- First Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="title">Titre</label>
                    <input class="validate" name="title" id="title" type="text">
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <!-- TODO: Changer couleur select -->
                    <select name="artists" id="artists">
                        <option disabled value="" selected>Veuillez choisir un artiste</option>
                        <?php foreach ($artists as $artist): ?>
                            <option value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="artists">Artiste</label>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="year">Année</label>
                    <input class="validate" name="year" id="year" type="text">
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="genre">Genre</label>
                    <input class="validate" name="genre" id="genre" type="text">
                </div>
            </div>
            <!-- Fifth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="label">Label</label>
                    <input class="validate" name="label" id="label" type="text">
                </div>
            </div>
            <!-- Sixth Row -->
            <div class="row">
                <div class="col s12 input-field">
                    <label for="price">Prix</label>
                    <input class="validate" name="price" id="price" type="text">
                </div>
            </div>
            <!-- Seventh Row -->
            <div class="row">
                <div class="col s12 file-field input-field">
                    <div class="btn deep-orange lighten-1">
                        <span>Image</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <!-- TODO  Renommer l'ID en quelque de mieux quand même -->
                        <label for="filePath"></label>
                        <input class="file-path validate" name="filePath" id="filePath" type="text">
                    </div>
                </div>
            </div>
            <!-- Eigth row -->
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
