<?php
require_once "../../models/connection.php";
require_once "../../controllers/discs/details.php";
?>

<!doctype html>
<html lang="fr">
<?php include_once "../templates/head.php" ?>
<body>
<?php include_once "../templates/navbar.php" ?>

<main role="main">
    <div class="container">
        <h1 class="center-align">Détails</h1>
        <form>
            <!-- First Row -->
            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="title">Titre</label>
                        <input disabled name="title" id="title" type="text" value="<?= $disc->disc_title ?>">
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="artist">Artiste</label>
                        <input disabled name="artist" id="artist" type="text" value="<?= $disc->artist_name ?>">
                    </div>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="year">Année</label>
                        <input disabled name="year" id="year" type="text" value="<?= $disc->disc_year ?>">
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="genre">Genre</label>
                        <input disabled name="genre" id="genre" type="text" value="<?= $disc->disc_genre ?>">
                    </div>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="label">Label</label>
                        <input disabled name="label" id="label" type="text" value="<?= $disc->disc_label ?>">
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="input-field">
                        <label for="price">Prix</label>
                        <input disabled name="price" id="price" type="text" value="<?= $disc->disc_price ?>€">
                    </div>
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col s12 m6">
                    <img
                        alt="Image du disque"
                        class="responsive-img"
                        src="../../assets/img/<?= $disc->disc_picture ?>"
                    >
                </div>
            </div>
        </form>

        <!-- Floating action buttons -->
        <div class="fixed-action-btn toolbar">
            <a class="btn-floating btn-large deep-orange lighten-1">
                <i class="large material-icons">info</i>
            </a>
            <ul>
                <li><a class="waves-effect waves-light" href="list.php"><i class="material-icons">undo</i></a></li>
                <li><a class="waves-effect waves-light" href="update.php"><i class="material-icons">edit</i></a></li>
                <li>
                    <a class="waves-effect waves-light" href="delete.php">
                        <i class="material-icons">delete_forever</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</main>

<?php include_once "../templates/footer.php" ?>
</body>
</html>