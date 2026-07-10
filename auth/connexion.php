<?php

// Connexion

require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

// Variables


$message = "";

// Traitement


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    // Recherche de l'utilisateur

    $sql = "SELECT * FROM lecteurs WHERE email = :email";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        "email" => $email
    ]);

    $lecteur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($lecteur && password_verify($mot_de_passe, $lecteur["mot_de_passe"])) {

        $_SESSION["lecteur"] = [

            "id" => $lecteur["id"],
            "nom" => $lecteur["nom"],
            "prenom" => $lecteur["prenom"],
            "email" => $lecteur["email"],
            "role" => $lecteur["role"]

        ];

        header("Location: ../index.php");
        exit();

    } else {

        $message = "Email ou mot de passe incorrect.";

    }

}

?>

<main class="container">

    <h1>Connexion</h1>

    <br>

    <?php if (!empty($message)): ?>

        <p><?= htmlspecialchars($message) ?></p>

    <?php endif; ?>

    <form method="POST">

        <input
            type="email"
            name="email"
            placeholder="Adresse email"
            required
        >

        <input
            type="password"
            name="mot_de_passe"
            placeholder="Mot de passe"
            required
        >

        <button type="submit">

            Se connecter

        </button>

    </form>

</main>

<?php require_once "../includes/footer.php"; ?>