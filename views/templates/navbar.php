<header role="banner">
    <!-- Navbar -->
    <nav aria-label="Barre de navigation" role="navigation">
        <div class="deep-orange lighten-1 nav-wrapper">
            <!-- Logo -->
            <a href="../../index.php" class="brand-logo center">Velvet Record</a>
            <a aria-haspopup="true" class="sidenav-trigger" data-target="mobile-nav" href="#">
                <i class="material-icons">menu</i>
            </a>
            <!-- Left Links -->
            <ul class="left hide-on-med-and-down">
                <li><a href="../artists/list.php">Artistes</a></li>
                <li><a href="../discs/list.php">Disques</a></li>
            </ul>
            <!-- Right Links -->
            <ul class="right hide-on-med-and-down">
                <?php if (!isset($_SESSION["connected"])) : ?>
                    <li><a href="../auth/signup.php">Créer un compte</a></li>
                    <li><a href="../auth/login.php">Connexion</a></li>
                <?php else: ?>
                    <li><a href="../../controllers/auth/logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Mobile navigation -->
        <div aria-labelledby="mobile-nav" role="navigation">
            <ul class="sidenav" id="mobile-nav">
                <li><a href="../../index.php">Accueil</a></li>
                <li><a href="../artists/list.php">Artistes</a></li>
                <li><a href="../discs/list.php">Disques</a></li>
                <li><div class="divider"></div></li>
                <?php if (!isset($_SESSION["connected"])) : ?>
                    <li><a href="../auth/signup.php">Créer un compte</a></li>
                    <li><a href="../auth/login.php">Connexion</a></li>
                <?php else: ?>
                    <li><a href="../../controllers/auth/logout.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>