<?php
include_once 'helpers/session.php';
include_once 'helpers/config.php';

$alreadySignedIn = false;

// Traiter les informations d'inscription
if ($_POST && isset($_POST["sign-in"])) {

  $email = $_POST["email"];
  $password = $_POST["mdp"];
  $hash = password_hash($password, PASSWORD_BCRYPT);

  // Vérifier que le compte n'existe pas
  $sel = $database->prepare('SELECT `id` FROM `users` WHERE `email` = :email');
  $sel->execute([ 'email' => $email ]);
  $alreadySignedIn = $sel->rowCount() > 0;

  if (!$alreadySignedIn) {

    // Créer le compte
    $ins = $database->prepare("INSERT INTO `users`(`email`, `password`) VALUES (:email, :password)");
    $ins->execute([ 'email' => $email, 'password' => $hash ]);

    // Créer une session
    $_SESSION["active"] = true;
    $_SESSION["email"] = $email;

    header("Location: ./index.php");
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('./partials/head.php') ?>

<body>

    <?php include('./partials/header.php') ?>

<form class='kaka' action="inscription.php" method="post">
     
<input type="hidden" name="sign-in" >
<h1>S'inscrire</h1>
    <div class="social-media">
      <p><i class="fab fa-google"></i></p>
      <p><i class="fab fa-youtube"></i></p>
      <p><i class="fab fa-facebook-f"></i></p>
      <p><i class="fab fa-twitter"></i></p>
    </div>
    <p class="choose-email">ou utiliser mon adresse e-mail :</p>
    
    <div class="inputs">
      <input type="email" placeholder="Email" name="email" />
      <input type="password" placeholder="Mot de passe" name="mdp">
    </div>

    <!-- Afficher l'erreur en dessous du formulaire -->
    <?php if ($alreadySignedIn): ?>
      <p>Vous êtes déjà inscrit !</p>
    <?php endif; ?>
    
    <p class="inscription">J'ai déjà un <span>compte</span>. Je me <a href="connexion.php"><span>connecte</span></a>.</p>
    <div align="center">
      <button type="submit">S'inscrire</button>
    </div>
  </form>
 
  <?php include('./partials/footer.php') ?>

</body>
</html>