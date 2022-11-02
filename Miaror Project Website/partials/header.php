<header>
    <a href="#" class="logo"><span>M</span>iaror</a>
    <div class="menuToggle" onclick="toggleMenu();"></div>
    <u1 class="navbar">
        <li><a href="index.php" onclick="toggleMenu();">Accueil</a></li>
        <li><a href="apropos.php" onclick="toggleMenu();">À propos</a></li>
        <li><a href="abonnement.php" onclick="toggleMenu();">Abonnement</a></li>
        <li><a href="blog.php" onclick="toggleMenu();">Blog</a></li> 
        <!-- Afficher l'email et le bouton de déconnexion, si connecté -->
        <?php if ($_SESSION["active"]): ?>
            <li><a href="administration.php" onclick="toggleMenu();">Administration</a></li>
            <li>
                <?=$_SESSION["email"] ?>
                <i class="fas fa-chevron-down"></i>
                <ul class="details">
                    <li>
                        <!-- Utilisation d'un formulaire pour faire une requête POST -->
                        <form method="post">
                            <input type="hidden" name="log-out">
                            <input type=submit value="Se déconnecter" />
                        </form>
                    </li>
                </ul>
            </li>
        <!-- Sinon afficher les boutons de connexion et d'inscription -->
        <?php else: ?>
            <li><a href="connexion.php" onclick="toggleMenu();">Connexion</a></li>
            <li><a href="inscription.php" onclick="toggleMenu();">Inscription</a></li>
        <?php endif; ?>
    </u1>
</header>
