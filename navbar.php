<?php

require_once __DIR__ . "/auth.php";

?>


<header>

    <nav>

        <h2><?= APP_NAME ?></h2>

        <ul>

            <li><a href="<?= BASE_URL ?>">Accueil</a></li>

            <li><a href="<?= BASE_URL ?>results.php">Livres</a></li>

            <li><a href="<?= BASE_URL ?>wishlist.php">Ma liste</a></li>

            <!-- Visible uniquement pour l'administrateur -->

            <?php if(estAdmin()): ?>

                <li><a href="<?= BASE_URL ?>admin/dashboard.php">Administration</a></li>

            <?php endif; ?>

            <?php if (estConnecte()): ?>

                <li>

                    Bonjour <?= htmlspecialchars($_SESSION["lecteur"]["prenom"]) ?>

                </li>

                <li>

                    <a href="<?= BASE_URL ?>auth/deconnexion.php">

                        Déconnexion

                    </a>

                </li>

            <?php else: ?>

                <li>

                    <a href="<?= BASE_URL ?>auth/connexion.php">

                        Connexion

                    </a>

                </li>

                <li>

                    <a href="<?= BASE_URL ?>auth/inscription.php">

                        Inscription

                    </a>

                </li>

            <?php endif; ?>

        </ul>

    </nav>

</header>



