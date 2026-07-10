<?php

require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/navbar.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = trim($_POST["nom"]);
    $prenom = trim($_POST["prenom"]);
    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];
    $confirmation = $_POST["confirmation"];

    if ($mot_de_passe !== $confirmation) {

        $message = "Les mots de passe ne correspondent pas.";

    } else {

        // Vérifier si l'email existe déjà
        $sql = "SELECT id FROM lecteurs WHERE email = :email";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            "email" => $email
        ]);

        if ($stmt->rowCount() > 0) {

            $message = "Cette adresse email existe déjà.";

        } else {

            $motDePasseHash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

            $sql = "INSERT INTO lecteurs(nom, prenom, email, mot_de_passe)

                    VALUES(:nom,:prenom,:email,:mot_de_passe)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "mot_de_passe" => $motDePasseHash
            ]);

            $idLecteur = $pdo->lastInsertId();

            $_SESSION["lecteur"] = [

                
                "id" => $idLecteur,
                "nom" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "role" => "lecteur"
                ];


                // Message temporaire       
                $_SESSION["flash_success"] = "Bienvenue {$prenom} ! Votre compte a été créé avec succès.";





                header("Location: " . BASE_URL);

                exit();



        }

    }

}

?>

<main class="container">

    <h1>Créer un compte</h1>

    <br>

    <?php if(!empty($message)): ?>

        <p><?= $message ?></p>

    <?php endif; ?>

    <form method="POST">

        <input type="text" name="nom" placeholder="Nom" required>

        <input type="text" name="prenom" placeholder="Prénom" required>

        <input type="email" name="email" placeholder="Adresse email" required>

        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>

        <input type="password" name="confirmation" placeholder="Confirmer le mot de passe" required>

        <button type="submit">

            S'inscrire

        </button>

    </form>

</main>

<?php

require_once "../includes/footer.php";

?>