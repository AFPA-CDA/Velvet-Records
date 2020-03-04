<?php require_once "../../controllers/discs/details.php"; ?>

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
                <div class="col s12">
                    <div class="input-field">
                        <label for="title">Titre</label>
                        <input disabled name="title" id="title" type="text" value="<?= $discDetails->disc_title ?>">
                    </div>
                </div>
            </div>
            <!-- Second Row -->
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <label for="artist">Artiste</label>
                        <input disabled name="artist" id="artist" type="text" value="<?= $discDetails->artist_name ?>">
                    </div>
                </div>
            </div>
            <!-- Third Row -->
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <label for="year">Année</label>
                        <input disabled name="year" id="year" type="text" value="<?= $discDetails->disc_year ?>">
                    </div>
                </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <label for="genre">Genre</label>
                        <input disabled name="genre" id="genre" type="text" value="<?= $discDetails->disc_genre ?>">
                    </div>
                </div>
            </div>
            <!-- Fifth Row -->
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <label for="label">Label</label>
                        <input disabled name="label" id="label" type="text" value="<?= $discDetails->disc_label ?>">
                    </div>
                </div>
            </div>
            <!-- Sixth Row -->
            <div class="row">
                <div class="col s12">
                    <div class="input-field">
                        <label for="price">Prix</label>
                        <input disabled name="price" id="price" type="text" value="<?= $discDetails->disc_price ?>€">
                    </div>
                </div>
            </div>
            <!-- Seventh Row -->
            <div class="row">
                <div class="col s12">
                    <img
                        alt="Image du disque"
                        class="responsive-img"
                        id="imagePreview"
                        src="../../assets/img/<?= $discDetails->disc_picture ?>"
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
                <li>
                    <a class="waves-effect waves-light" href="update.php?disc_id=<?= $discDetails->disc_id ?>">
                        <i class="material-icons">edit</i>
                    </a>
                </li>
                <li>
                    <a
                        class="btn waves-effect waves-light"
                        data-id="<?=$discDetails->disc_id ?>"
                        href="../../controllers/discs/delete.php?disc_id=<?= $discDetails->disc_id ?>"
                        id="deleteButton"
                    >
                        <i class="material-icons">delete_forever</i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</main>

<?php include_once "../templates/footer.php" ?>
<script src="../../assets/js/vendors/sweetalert2.min.js"></script>
<script src="../../assets/js/discs/delete.js"></script>
</body>
</html>
