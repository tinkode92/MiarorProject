<?php include_once 'helpers/session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>
    <?php include ('./partials/header.php') ?>
    <section class="banniere" id="banniere">
    <div class="contenu">
        <h2>MERCI !</h2>
        <?php
// Afficher le code de parrainage, s'il est donné
if ($_GET && isset($_GET['code']))
{
    echo '<p>';
    echo 'Votre code de parrainage : ' . $_GET['code'];
    echo '</p>';
}
?>
</div>
</section>

    <?php include ('./partials/footer.php') ?>

</body>

</html>
