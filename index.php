<?php require_once "controllers/index.php" ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="Accueil de Velvet Records" name="description">
    <title>Velvet Records - Accueil</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/vendors/animate.min.css">
    <link rel="stylesheet" href="assets/css/vendors/materialize.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
<header role="banner">
    <!-- Navbar -->
    <nav aria-label="Barre de navigation" role="navigation">
        <div class="deep-orange lighten-1 nav-wrapper">
            <!-- Logo -->
            <a href="index.php" class="brand-logo center">Velvet Record</a>
            <a aria-haspopup="true" class="sidenav-trigger" data-target="mobile-nav" href="#">
                <i class="material-icons">menu</i>
            </a>
            <!-- Links -->
            <ul class="left hide-on-med-and-down">
                <li><a href="views/artists/list.php">Artistes</a></li>
                <li><a href="views/discs/list.php">Disques</a></li>
            </ul>
        </div>

        <!-- Mobile navigation -->
        <div aria-labelledby="mobile-nav" role="navigation">
            <ul class="sidenav" id="mobile-nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="views/artists/list.php">Artistes</a></li>
                <li><a href="views/discs/list.php">Disques</a></li>
            </ul>
        </div>
    </nav>
</header>

<main role="main">
    <section class="section" role="region">
        <h1 class="center-align">Nouveaux Artistes</h1>
        <div class="row">
            <?php foreach ($artists as $artist): ?>
                <div class="col s12 m4">
                    <div class="animated card fast zoomIn">
                        <div class="card-content">
                            <div class="center-align row">
                                <span class="card-title">
                                    <b><?= $artist->artist_name ?></b>
                                </span>
                            </div>
                        </div>
                        <div class="card-action" id="artistButtons">
                            <a
                                class="btn deep-orange lighten-1 waves-effect waves-light"
                                href="views/artists/details.php?artist_id=<?= $artist->artist_id ?>"
                            >
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="section" role="region">
        <h1 class="center-align">Nouveaux Disques</h1>
        <div class="row">
            <?php foreach ($discs as $disc): ?>
                <div class="col s12 m4">
                    <div class="animated card delay-1s fast zoomIn">
                        <div class="card-image">
                            <img
                                alt="Image du disque"
                                class="responsive-img"
                                src="assets/img/<?= $disc->disc_picture ?>"
                            >
                        </div>
                        <div class="card-content">
                            <div class="center-align row">
                                <p class="flow-text" id="artistName">
                                    <?= $disc->artist_name ?> (<?= $disc->disc_title ?>)
                                </p>
                                <div class="col s12">
                                    <p><b>Année</b>: <?= $disc->disc_year ?></p>
                                    <p><b>Label</b>: <?= $disc->disc_label ?></p>
                                    <p><b>Genre</b>: <?= $disc->disc_genre ?></p>
                                    <p><b>Prix</b>: <?= $disc->disc_price ?>€</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-action">
                            <a
                                class="btn deep-orange lighten-1"
                                id="detailsButton"
                                href="views/discs/details.php?disc_id=<?= $disc->disc_id ?>"
                            >
                                Détails
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<script src="assets/js/vendors/materialize.min.js"></script>
<script src="assets/js/index.js"></script>
</body>
</html>