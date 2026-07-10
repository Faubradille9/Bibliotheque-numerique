



<?php


// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/auth.php";
require_once "../includes/admin_navbar.php";
require_once "../includes/upload.php";


// Sécurité


redirigerSiNonAdmin();


// Variables


$message = "";


// Traitement


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST["titre"]);
    $auteur = trim($_POST["auteur"]);
    $maison = trim($_POST["maison_edition"]);
    $nombre = (int) $_POST["nombre_exemplaire"];
    $description = trim($_POST["description"]);

    // Vérification des champs

    if (
        empty($titre) ||
        empty($auteur) ||
        empty($maison) ||
        empty($description)
    ) {

        $message = "Veuillez remplir tous les champs.";

    } else {

        // Téléversement des fichiers

        $image = televerserImage($_FILES["image"]);

        $pdf = televerserPDF($_FILES["fichier_pdf"]);

        if (!$image || !$pdf) {

            $message = "Erreur lors du téléversement des fichiers.";

        } else {

            $sql = "INSERT INTO livres
                    (
                        titre,
                        auteur,
                        description,
                        maison_edition,
                        nombre_exemplaire,
                        image,
                        fichier_pdf
                    )

                    VALUES
                    (
                        :titre,
                        :auteur,
                        :description,
                        :maison,
                        :nombre,
                        :image,
                        :pdf
                    )";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([

                "titre"=>$titre,
                "auteur"=>$auteur,
                "description"=>$description,
                "maison"=>$maison,
                "nombre"=>$nombre,
                "image"=>$image,
                "pdf"=>$pdf

            ]);

            header("Location: livres.php");

            exit();

        }

    }

}

?>

<main class="container">

    <h1>Ajouter un livre</h1>

    <br>

    <?php if(!empty($message)): ?>

        <p class="warning">

            <?= htmlspecialchars($message) ?>

        </p>

    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <input
            type="text"
            name="titre"
            placeholder="Titre"
            required
        >

        <input
            type="text"
            name="auteur"
            placeholder="Auteur"
            required
        >

        <input
            type="text"
            name="maison_edition"
            placeholder="Maison d'édition"
            required
        >

        <input
            type="number"
            name="nombre_exemplaire"
            placeholder="Nombre d'exemplaires"
            required
        >

        <textarea
            name="description"
            rows="8"
            placeholder="Description"
            required
        ></textarea>

        <label>

            Couverture du livre

        </label>

        <input
            type="file"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
            required
        >

        <label>

            Livre PDF

        </label>

        <input
            type="file"
            name="fichier_pdf"
            accept=".pdf"
            required
        >

        <button type="submit">

            Ajouter le livre

        </button>

    </form>

</main>

<script>

const inputImage = document.getElementById("image");

const preview = document.getElementById("previewImage");

inputImage.addEventListener("change", function () {

    const fichier = this.files[0];

    if (fichier) {

        preview.src = URL.createObjectURL(fichier);

        preview.style.display = "block";

    }

});

</script>

<?php require_once "../includes/footer.php"; ?>