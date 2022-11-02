<?php
include_once 'helpers/session.php';
include_once 'helpers/config.php';

// N'autoriser l'accès qu'aux admins
if (!$_SESSION["active"])
{
    http_response_code(403);
    die('Forbidden');
}

// Permet d'afficher les boutons de suppression des components
$admin = true;

// Suppression d'un avis
if ($_POST && isset($_POST["suppr-avis"]))
{
    $id = $_POST["id"];
    $del = $database->prepare('DELETE FROM `avis` WHERE `id` = :id');
    $del->execute([ 'id' => $id ]);
}

// Suppression d'un article
if ($_POST && isset($_POST["suppr-article"]))
{
    $id = $_POST["id"];
    $del = $database->prepare('DELETE FROM `articles` WHERE `id` = :id');
    $del->execute([ 'id' => $id ]);
}

// Post d'un article
if ($_POST && isset($_POST["article"]))
{
    unset($_POST["article"]);
    $requeteEnvoi = $database->prepare("INSERT INTO `articles` VALUES (null, :tag, :titre, :imageExt, :content)");
    $uploadOk = 1;

    // Vérifier que c'est bien une image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        $uploadOk = 0;
    }

    // Restreindre la taille de l'image
    if ($_FILES["image"]["size"] > 500000) {
        $uploadOk = 0;
    }

    $imageExt = strtolower(pathinfo(basename($_FILES["image"]["name"]),PATHINFO_EXTENSION));

    // Restraindre le format de l'image
    if($imageExt != "jpg" && $imageExt != "png" && $imageExt != "jpeg" && $imageExt != "gif" ) {
        $uploadOk = 0;
    }

    // Enregistrer l'article dans la bdd
    $requeteEnvoi->execute(array_merge($_POST, [ "imageExt" => $imageExt ]));
    $id = $database->lastInsertId();

    $target_dir = "images/miniatures/";
    $target_file = $target_dir . 'article-' . $id . '.' . $imageExt;

    // Si tout est bon, on télécharge le fichier sur le serveur
    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }
}

// Récuperer les avis
$requeteFetch = $database->prepare('SELECT * FROM avis');
$requeteFetch->execute();
$Fetch = $requeteFetch->fetchAll(PDO::FETCH_ASSOC);

// Récuperer les articles
$sel = $database->prepare('SELECT * FROM `articles`');
$sel->execute();
$articles = $sel->fetchAll(PDO::FETCH_ASSOC)

?>

<!DOCTYPE html>
<html lang="en">

<?php include ('./partials/head.php') ?>

<body>
    <script src="https://cdn.tiny.cloud/1/t686zu4r6odhk7mm601jkoc3a2cjh3wvoq91vn6w6p67v4s6/tinymce/6/tinymce.min.js"       
        referrerpolicy="origin"></script>    

    <?php include ('./partials/header.php') ?>
    
    <section class="temoignage" id="temoignage">
        
    <div class="titre blanc">
        <h2 class="titre-texte">Les <span>A</span>vis</h2>
    </div>
    <div class="contenu">
        <!-- Afficher les avis -->
        <?php foreach ($Fetch as $avis) include ("components/avis.php") ?>
    </div>
    </section>


    <section class="Blog" id="Blog">
        <div class="titre"> 
            <h2 class="titre-texte"><span>A</span>rticles</h2>
        </div>
        <!-- Boutons de filtrage -->
        <div class="buttons">
            <button class="btnfl" onclick="filterContenu('all')">Show All</button>
            <button class="btnfl" onclick="filterContenu('programmation')">Programmation</button>
            <button class="btnfl" onclick="filterContenu('cybersecurite')">Cybersécurité</button>
            <button class="btnfl" onclick="filterContenu('sante')">Santé</button>
        </div>
        <div class="contenu">
            <!-- Afficher les articles -->
            <?php foreach ($articles as $article) include ("components/apercu—article.php") ?>
        </div>
        <!-- Formulaire pour la création d'article -->
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="article">
            <div class="titre noir">
                <h2 class="titre-text"><span>A</span>jouter un article</h2>
            </div>
            <div class="contactform">
                <div class="inputboite">
                    <input type="text" name="titre" placeholder="Titre">
                </div>
                <div class="inputboite">
                    <select name="tag" id="tag" >
                        <option disabled>Veuillez choisir une étiquette</option>
                        <option value="programmation">Programmation</option>
                        <option value="cybersecurite">Cyber Sécurité</option>
                        <option value="sante">Santé</option>
                    </select>
                </div>
                <div class="inputboite">
                    <label for="image">Miniature</label>
                    <input type="file" name="image" id="image">
                </div>
                <textarea name="content" id="article-content"></textarea>

                <!-- Le premier bouton permet de compiler le contenu en html et le placer dans la valeur de #article-content -->
                <div class="inputboite">
                    <a onclick="postArticle()" class="btn1 button primary" >Envoyer</a>   
                </div>
                <!-- Le second bouton, qui est caché à l'utilisateur, permet de faire une requête POST en javascript -->
                <input type="submit" id="article-submit" style="display: none"; />
            </div>
        </form>
    </section>
    <script src="app.js"></script>
    <script>
        // Lancement de l'éditeur wysiwyg
        tinymce.init({
            selector: '#article-content',
            plugins: 'a11ychecker advcode casechange formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinymcespellchecker',
            toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter image editimage pageembed permanentpen table tableofcontents',
            toolbar_mode: 'floating',
        });
    </script>
    <?php include ('./partials/footer.php') ?>

</body>

</html>
