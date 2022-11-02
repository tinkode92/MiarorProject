<?php 
include_once 'helpers/session.php'; 
include_once 'helpers/config.php'; 

if ($_GET && isset($_GET["id"])) {
    $sel = $database->prepare('SELECT * FROM `articles` WHERE `id` = :id');
    $sel->execute($_GET);
    
    if ($sel->rowCount() > 0)
    {
        $article = $sel->fetch(PDO::FETCH_ASSOC);
    } else {
        http_response_code(404);
        die('Not found');
    }
} else {
    http_response_code(403);
    die('Forbidden');
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('./partials/head.php') ?>

<body>

    <?php include('./partials/header.php') ?>

    <div class="padding-head"></div>
    <section>
        <div class="row">
            <div class="col50"> 
                <h2 class="titre-texte"><?= $article["title"] ?></h2>
                <?= $article["content"] ?>
            </div> 
            <div class="col50">
                <div class="img">
                    <img src="images/miniatures/article-<?= $article["id"] ?>.<?= $article["imageExt"] ?>" alt="image">
                </div>
            </div>
        </div>
    </section>

    <?php include('./partials/footer.php') ?>

</body>
</html>