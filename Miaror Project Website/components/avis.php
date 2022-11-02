<div class="box">
    <div class="imbox">
        <img src="https://randomuser.me/api/portraits/men/<?=$avis['id'] ?>.jpg" alt="Photo aléatoire d'homme">
    </div>
    <div class="text"> 
        <p><?=$avis['message'] ?> </p>
        <p><?=$avis['note'] ?> </p>
        <h3><?=$avis['name'] ?> </h3>
        <!-- Afficher le bouton supprimer, si on est en mode administration -->
        <!-- Utilisation d'un formulaire afin de faire une requête POST -->
        <?php if (isset($admin) && $admin): ?>
        <form method="post">
            <input type="hidden" name="suppr-avis">
            <input type="hidden" name="id" value="<?= $avis['id'] ?>">
            <div class="button danger">
                <i class="fas fa-trash"></i>
                <input type=submit value="Supprimer"/>
            </div>
        </form>
        <?php endif; ?>
    </div>
</div>
