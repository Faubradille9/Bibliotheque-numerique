<?php

require_once "includes/header.php";
require_once "includes/navbar.php";

?>


<?php if (isset($_SESSION["flash_success"])): ?>

    <div class="success-message">

        <?= htmlspecialchars($_SESSION["flash_success"]) ?>

    </div>

    <?php unset($_SESSION["flash_success"]); ?>

<?php endif; ?>



<main class="container">

    <section class="hero">

        <h1>Bienvenue dans votre bibliothèque numérique</h1>

        <p>
            Découvrez une large collection de livres numériques.
            Recherchez vos ouvrages préférés et ajoutez-les à votre liste de lecture.
        </p>

    </section>

    <section class="search-section">

        <h2>Rechercher un livre</h2>

        <form action="results.php" method="GET">

            <input type="text" name="search" placeholder="Rechercher par titre ou auteur..." required>

            <button type="submit">Rechercher</button>

        </form>

    </section>

</main>

<?php

require_once "includes/footer.php";

?>