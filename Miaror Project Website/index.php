<?php
include_once 'helpers/config.php';
include_once 'helpers/session.php';

if ($_POST && isset($_POST["avis"]))
{
    unset($_POST["avis"]);
    $requeteEnvoi = $database->prepare("INSERT INTO avis VALUES (null, :message, :name, :note)");
    $requeteEnvoi->execute($_POST);
}
$requeteFetch = $database->prepare('SELECT * FROM avis');
$requeteFetch->execute();
$Fetch = $requeteFetch->fetchAll(PDO::FETCH_ASSOC)
?>

<?php
$alreadyBetaTester = false;

// Traiter les informations d'inscription
if ($_POST && isset($_POST["betaTester"]))
{

    $email = $_POST["email"];
    $name = $_POST["nom"];
    $forname = $_POST["prenom"];

    // Vérifier que le compte n'existe pas déjà
    $sel = $database->prepare('SELECT `id` FROM `betaTesters` WHERE `email` = :email');
    $sel->execute(['email' => $email]);
    $alreadyBetaTester = $sel->rowCount() > 0;

    if (!$alreadyBetaTester)
    {

        // Générer un code partenaire
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 8;

        do
        {
            $partnerCode = '';
            for ($i = 0;$i < 8;$i++)
            {
                $index = rand(0, strlen($characters) - 1);
                $partnerCode .= $characters[$index];
            }

            // On recommence si le code existe déjà
            $sel = $database->prepare('SELECT `id` FROM `betaTesters` WHERE `partnerCode` = :partnerCode');
            $sel->execute(['partnerCode' => $partnerCode]);
        }
        while ($sel->rowCount() > 0);

        // Enregistrer les informations
        $ins = $database->prepare("INSERT INTO `betaTesters` (`email`, `name`, `forname`)" . "VALUES (:email, :name, :forname)");
        $ins->execute(['email' => $email, 'name' => $name, 'forname' => $forname]);

        // Enregistrer le code partenaire
        $ins = $database->prepare("INSERT INTO `partnerCodes`(`email`, `code`) VALUES (:email, :code)");
        $ins->execute(['email' => $email, 'code' => $partnerCode]);

        // Rediriger vers la page de remerciement
        header('Location: remerciement.php?code=' . $partnerCode);

    }
}

?>



<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>

<?php include ('./partials/header.php') ?>

<section class="banniere" id="banniere">
    <div class="contenu">
        <h2>MIAROR©</h2>
        <p>PLUS QU'UN REFLET. C'EST VOUS</p>
        <p>La société qui a mis au point un système de domotique intégrant de l'intelligence artificielle afin d'optimiser la consommation d'énergie, ainsi que la sécurité et le confort.</p>
    <div>
         <a href="#" class="btn1">S'abonner</a>
         <button class="modal-btn modal-trigger">Bêta Tester</button>

         <div class="modal-container">

<div class="overlay modal-trigger"></div>

<div class="modal" role="dialog" aria-labelledby="modalTitle" aria-describedby="dialogDesc">
    <button aria-label="close modal" class="close-modal modal-trigger">X</button>
    <form class="contactform1" action="index.php" method="post" >
        <input type="hidden" name="betaTester">
        <h3>Formulaire D'Inscription</h3>
        <div class="inputboite">
            <input type="text" name="email" id="email" placeholder="E-mail">
        </div>
        <div class="inputboite">
        <input type="text" name="nom" id="nom" placeholder="Nom">
        </div>
        <div class="inputboite">
        <input type="text" name="prenom" id="prenom" placeholder="Prenom">
        </div>
        <div class="inputboite">
        <input type="submit" value="envoyer" class="button primary btnfl"></div>
    </form>
    <!-- Afficher l'erreur en dessous du formulaire -->
    <?php if ($alreadyBetaTester) echo '<p>Vous êtes déjà inscrit !</p>'; ?>
</div>

</div>


    </div>
    </div>
</section>
</section>
<section class="temoignage" id="temoignage">
    <div class="titre blanc">
        <h2 class="titre-texte">Que Disent Nos <span>C</span>lients</h2>
    </div>
    <div class="contenu">
        <?php foreach ($Fetch as $avis) include ("components/avis.php") ?>
    </div>
 </section>
    <script src="app.js"></script>
    <script>
         if (<?=!isset($alreadyBetaTester) || $alreadyBetaTester ?>) toggleModal();
    </script>

    <?php include ('./partials/footer.php') ?>

</body>
</html>
