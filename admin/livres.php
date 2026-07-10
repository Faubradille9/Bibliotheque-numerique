<?php

// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/auth.php";
require_once "../includes/admin_navbar.php";


// Sécurité


redirigerSiNonAdmin();


// Récupération des livres


$sql = "SELECT * FROM livres ORDER BY titre ASC";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container">

    <h1>Gestion des livres</h1>

    <br>

    <a href="ajouterLivre.php" class="btn">
        ➕ Ajouter un livre
    </a>

    <br><br>

    <table class="table-admin">

        <thead>

            <tr>

                <th>Couverture</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Exemplaires</th>
                <th>Actions</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach($livres as $livre): ?>

            <tr>

                <td>

                    <?php if(!empty($livre["image"])): ?>

                        <img
                            src="<?= BASE_URL . htmlspecialchars($livre["image"]) ?>"
                            class="mini-cover"
                            alt="<?= htmlspecialchars($livre["titre"]) ?>"
                        >

                    <?php else: ?>

                        Aucune image

                    <?php endif; ?>

                </td>

                <td><?= htmlspecialchars($livre["titre"]) ?></td>

                <td><?= htmlspecialchars($livre["auteur"]) ?></td>

                <td><?= $livre["nombre_exemplaire"] ?></td>

                <td>

                    <a
                        href="modifierLivre.php?id=<?= $livre["id"] ?>"
                        class="btn-modifier">

                        Modifier

                    </a>

                    <a href="supprimer_livre.php?id=<?= $livre["id"] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?')" class="btn-supprimer">

                       Supprimer

                    </a>

                    

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</main>

<?php require_once "../includes/footer.php"; ?>