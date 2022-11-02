<?php 
include_once 'helpers/config.php';
include_once 'helpers/session.php';

$sel = $database->prepare('SELECT * FROM `articles`');
$sel->execute();
$articles = $sel->fetchAll(PDO::FETCH_ASSOC)
?>

<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>

    <?php include ('./partials/header.php') ?>

<section>
    <section class="Blog" id="Blog">
        <div class="titre"> 
            <h2 class="titre-texte">Notre <span>B</span>log </h2>
            <p>On ne présente plus le blog Miaror. Plus qu’un simple blog c’est une véritable mine d’or en matière d’innovation business, marketing, high-tech ou encore design. Vous pourrez y retrouver des conférences, tutoriels divers et variés et conseils pour trouver un emploi dans le digital.</p>
        </div>
        <div class="buttons">
                <button class="btnfl" onclick="filterContenu('all')">Show All</button>
                <button class="btnfl" onclick="filterContenu('programmation')">Programmation</button>
                <button class="btnfl" onclick="filterContenu('cybersecurite')">Cybersécurité</button>
                <button class="btnfl" onclick="filterContenu('sante')">Santé</button>
        </div>

        <div class="contenu">

            <?php foreach ($articles as $article) include ("components/apercu—article.php") ?>
            
            <script src="app.js"></script>
        </div>
 </section>

    <?php include ('./partials/footer.php') ?>

</body>
</html>
