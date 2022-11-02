<?php
include_once 'helpers/config.php';
include_once 'helpers/session.php';

if ($_POST && isset($_POST["avis"]))
{
    unset($_POST["avis"]);
    $requeteEnvoi = $database->prepare("INSERT INTO avis VALUES (null, :message, :name, :note)");
    $requeteEnvoi->execute($_POST);
    var_dump($_POST);
}

$requeteFetch = $database->prepare('SELECT * FROM avis');
$requeteFetch->execute();
$Fetch = $requeteFetch->fetchAll(PDO::FETCH_ASSOC);


$sel = $database->prepare('SELECT * FROM `boosts`');
$sel->execute();
$boosts = $sel->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>

    <?php include ('./partials/header.php') ?>

    <section class="Abonnement" id="abonnement">
    <div class="titre" id="col20"> 
        <h2 class="titre-texte"><span>A</span>bonnement </h2>
        <p>*Des frais sont a prévoir pour la mise a disposition du miroir chez vous.</p>
    </div>
    <div class="contenu">
        <div class="pipi">
            <img class="imbox" src="./images/c1.jpg" alt="">
            <h3 class="text">Abonnement Mensuel</h3>
            <h3 class="text" id="prix1"> 30,99€</h3>
        </div>
        <div class="pipi">
            <img class="imbox" src="./images/c2.jpg" alt="">
            <h3 class="text">Abonnement Annuel</h3>
            <h3 class="text" id="prix2"> 25,99€</h3>
        </div> 
    </div>
    <div class="titre" id="row20">
        <?php foreach($boosts as $boost): ?>
            <div class="button primary">
                <label for="boost-<?= $boost["id"] ?>"><?= $boost["name"] ?> (+ <?= $boost["cost"] ?>€)</label>
                <input type="checkbox" id="boost-<?= $boost["id"] ?>" class="boost"/>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<section class="contact" id="contact">
<form method="post">
    <input type="hidden" name="avis">
     <div class="titre noir">
         <h2 class="titre-text"><span>L</span>aisser un avis</h2>
         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
     </div>
     <div class="contactform">
         <h3>Envoyer un message</h3>
         <div class="inputboite">
             <input type="text" name="name" placeholder="Pseudo">
         </div>
         <div class="inputboite">
            <input type="text" name="message" placeholder="commentaire">
         </div>
         <div class="inputboite">
            <input type="number" name="note" placeholder="Note sur 10">
         </div>
         <div class="inputboite">
             <input type="submit" value="envoyer">
         </div>
     </div>
</form>
</section>
    <?php include ('./partials/footer.php') ?>
    <script>
        const boosts = [];
        <?php
            foreach ($boosts as $boost) {
                echo "boosts.push(" . $boost["cost"] . ");";
            }
        ?>
    </script>
    <script src="app.js"></script>
</body>
</html>
