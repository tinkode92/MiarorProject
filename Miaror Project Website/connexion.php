<?php
include_once 'helpers/session.php';
include_once 'helpers/config.php';

$invalidCredentials = false;

// Traiter les informations d'inscription
if ($_POST && isset($_POST["log-in"]))
{

    $email = $_POST["email"];
    $password = $_POST["password"];

    // Vérifier que les identifiants correspondent
    $sel = $database->prepare('SELECT `password` FROM `users` WHERE `email` = :email');
    $sel->execute(['email' => $email]);
    if ($sel->rowCount() > 0)
    {
        $user = $sel->fetch(PDO::FETCH_ASSOC);
        $invalidCredentials = !password_verify($password, $user["password"]);
    }
    else
    {
        $invalidCredentials = true;
    }

    if (!$invalidCredentials)
    {
        // Créer une session
        $_SESSION["active"] = true;
        $_SESSION["email"] = $email;

        header("Location: ./index.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>

  <?php include ('./partials/header.php') ?>
  
  <form class='kaka' action="connexion.php" method="post">
    <input type="hidden" name="log-in">

    <h1>Se connecter</h1>
    <div class="social-media">
      <p><i class="fab fa-google"></i></p>
      <p><i class="fab fa-youtube"></i></p>
      <p><i class="fab fa-facebook-f"></i></p>
      <p><i class="fab fa-twitter"></i></p>
    </div>
    <p class="choose-email">ou utiliser mon adresse e-mail :</p>
    
    <div class="inputs">
      <input name="email" type="email" placeholder="Email" />
      <input name="password" type="password" placeholder="Mot de passe">
    </div>

    <!-- Affichage de l'erreur en dessous du formulaire -->
    <?php if ($invalidCredentials): ?>
      <p>Les identifiants ne correspondent pas !</p>
    <?php endif; ?>
    
    <p class="inscription">Je n'ai pas de <span>compte</span>. Je m'en <a href="inscription.php"><span>crée un</span></a>.</p>
    <div align="center">
      <button type="submit">Se connecter</button>
    </div>
  </form>
  
  <?php include ('./partials/footer.php') ?>

</body>
</html>
