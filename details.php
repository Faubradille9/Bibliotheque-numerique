<?php

require_once "config/database.php";
require_once "includes/header.php";
require_once "includes/navbar.php";

// Vérifier si un id est présent dans l'URL
if (!isset($_GET["id"]) || empty($_GET["id"])) {

    die("Livre introuvable.");

}

$id = (int) $_GET["id"];

// Préparer la requête
$sql = "SELECT * FROM livres WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "id" => $id
]);

$livre = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier que le livre existe
if (!$livre) {

    die("Ce livre n'existe pas.");

}

?>

<main class="container">


    <?php if (isset($_GET["message"])): ?>

        <?php if ($_GET["message"] === "ajoute"): ?>

            <p class="success">
                ✅ Livre ajouté à votre liste de lecture.
            </p>

            <?php elseif ($_GET["message"] === "existe"): ?>

            <p class="warning">
                ⚠️ Ce livre est déjà dans votre liste de lecture.
            </p>

        <?php endif; ?>

    <?php endif; ?>





    <div class="details-card">

        <?php if (!empty($livre["image"])): ?>

           <img src="<?= BASE_URL . htmlspecialchars($livre["image"]) ?>"alt="<?= htmlspecialchars($livre["titre"]) ?>" class="book-cover">

        <?php endif; ?>




        <h1><?= htmlspecialchars($livre["titre"]) ?></h1>

        <p>

            <strong>Auteur :</strong>

            <?= htmlspecialchars($livre["auteur"]) ?>

        </p>

        <p>

            <strong>Maison d'édition :</strong>

            <?= htmlspecialchars($livre["maison_edition"]) ?>

        </p>

        <p>

            <strong>Nombre d'exemplaires :</strong>

            <?= htmlspecialchars($livre["nombre_exemplaire"]) ?>

        </p>

        <h3>Description</h3>

        <p>

            <?= nl2br(htmlspecialchars($livre["description"])) ?>

        </p>

        <br>

        <a href="actions/ajouter_wishlist.php?id=<?= $livre["id"] ?>" class="btn">
            Ajouter à ma liste de lecture
        </a>

        <a href="<?= BASE_URL . htmlspecialchars($livre["fichier_pdf"]) ?>" class="btn" target="_blank">

            Lire / Télécharger

        </a>

        <a href="results.php" class="btn-retour">
            Retour
        </a>

    </div>

</main>

<?php

require_once "includes/footer.php";

?>