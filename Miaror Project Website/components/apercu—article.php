<div class="box <?= $article["tag"] ?>" id="box1">
    <img src="images/miniatures/article-<?= $article["id"] . '.' . $article["imageExt"] ?>">
    <p><?= $article["title"] ?></p>  
    <!-- Afficher le bouton supprimer, si on est en mode administration -->
    <!-- Utilisation d'un formulaire afin de faire une requête POST -->
    <?php if (isset($admin) && $admin): ?>
        <form method="post">
            <input type="hidden" name="suppr-article">
            <input type="hidden" name="id" value="<?= $article['id'] ?>">
            <div class="button danger">
                <i class="fas fa-trash"></i>
                <input type=submit value="Supprimer"/>
            </div>
        </form>
    <?php else: ?>
        <!-- Bouton uniquement pour la page blog -->
        <a href="article.php?id=<?= $article["id"] ?>" class="btn1 button primary" >Voir l'article</a>   
    <?php endif; ?>  
</div>