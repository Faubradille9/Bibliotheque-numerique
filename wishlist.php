<?php

// Connexion


require_once "config/database.php";
require_once "includes/header.php";
require_once "includes/navbar.php";
require_once "includes/auth.php";


// Vérifier la connexion


redirigerSiNonConnecte();


// Récupérer l'utilisateur connecté


$idLecteur = $_SESSION["lecteur"]["id"];


// Récupérer les livres de la wishlist


$sql = "SELECT
            livres.*,
            liste_lecture.date_ajout
        FROM liste_lecture

        INNER JOIN livres
            ON liste_lecture.id_livre = livres.id

        WHERE liste_lecture.id_lecteur = :id_lecteur

        ORDER BY liste_lecture.date_ajout DESC";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "id_lecteur" => $idLecteur
]);

$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container">



    <?php if (isset($_GET["message"]) && $_GET["message"] === "supprime"): ?>

        <p class="success">
            ✅ Le livre a été retiré de votre liste de lecture.
        </p>

    <?php endif; ?>

    <h1>Ma liste de lecture</h1>

    <br>

    <?php if(count($livres) > 0): ?>

        <?php foreach($livres as $livre): ?>

            <div class="card">

                <?php if(!empty($livre["image"])): ?>

                    <img
                        src="<?= BASE_URL . htmlspecialchars($livre["image"]) ?>"
                        alt="<?= htmlspecialchars($livre["titre"]) ?>"
                        class="wishlist-image"
                    >

                <?php endif; ?>

                <h2><?= htmlspecialchars($livre["titre"]) ?></h2>

                <p>

                    <strong>Auteur :</strong>

                    <?= htmlspecialchars($livre["auteur"]) ?>

                </p>

                <p>

                    <strong>Ajouté le :</strong>

                    <?= htmlspecialchars($livre["date_ajout"]) ?>

                </p>

                <a href="details.php?id=<?= $livre["id"] ?>" class="btn">

                    Voir les détails

                </a>

                <a href="actions/supprimer_wishlist.php?id=<?= $livre["id"] ?>" class="btn-supprimer">

                    Retirer

                </a>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>Votre liste de lecture est vide.</p>

    <?php endif; ?>

</main>

<?php require_once "includes/footer.php"; ?>