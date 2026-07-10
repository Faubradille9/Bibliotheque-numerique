<?php


// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";
require_once "../includes/auth.php";


// Sécurité


redirigerSiNonAdmin();


$sql="SELECT COUNT(*) FROM livres";

$totalLivres=$pdo->query($sql)->fetchColumn();

$sql="SELECT COUNT(*) FROM lecteurs";

$totalLecteurs=$pdo->query($sql)->fetchColumn();

$sql="SELECT COUNT(*) FROM liste_lecture";

$totalWishlist=$pdo->query($sql)->fetchColumn();

?>

<main class="container">

    <h1>Tableau de bord Administrateur</h1>

    <br>

    <p>

        Bienvenue
        <strong><?= htmlspecialchars($_SESSION["lecteur"]["prenom"]) ?></strong>

    </p>

    <br>

    <div class="admin-menu">

        <a href="livres.php" class="btn">

            Gérer les livres

        </a>

    </div>


    <div class="stats">

<div class="card">

<h2><?= $totalLivres ?></h2>

<p>Livres</p>

</div>

<div class="card">

<h2><?= $totalLecteurs ?></h2>

<p>Lecteurs</p>

</div>

<div class="card">

<h2><?= $totalWishlist ?></h2>

<p>Ajouts en liste</p>

</div>

</div>

</main>

<?php require_once "../includes/footer.php"; ?>