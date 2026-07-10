<?php

require_once "config/database.php";
require_once "includes/header.php";
require_once "includes/navbar.php";

// Vérifie si une recherche a été effectuée
$search = "";

if (isset($_GET["search"])) {
    $search = trim($_GET["search"]);
}

// Préparation de la requête
$sql = "SELECT * FROM livres
        WHERE titre LIKE :search
        OR auteur LIKE :search";

$stmt = $pdo->prepare($sql);

// Exécution de la requête
$stmt->execute([
    "search" => "%$search%"
]);

// Récupération des résultats
$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container">

    <h1>Résultats de la recherche</h1>

    <hr><br>

    <?php if(count($livres) > 0): ?>

        <?php foreach($livres as $livre): ?>

            <div class="card">

                <h2><?= htmlspecialchars($livre["titre"]) ?></h2>

                <p>

                    <strong>Auteur :</strong>

                    <?= htmlspecialchars($livre["auteur"]) ?>

                </p>

                <a href="details.php?id=<?= $livre["id"] ?>" class="btn">

                    Voir les détails

                </a>

            </div>

        <?php endforeach; ?>

    <?php else: ?>

        <p>Aucun livre trouvé.</p>

    <?php endif; ?>

</main>

<?php

require_once "includes/footer.php";

?>