<?php


// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/auth.php";
require_once "../includes/admin_navbar.php";
require_once "../includes/upload.php";


// Sécurité


redirigerSiNonAdmin();


// Vérifier l'identifiant


if (!isset($_GET["id"]) || empty($_GET["id"])) {

    header("Location: livres.php");
    exit();

}

$idLivre = (int) $_GET["id"];

// Récupérer le livre


$sql = "SELECT * FROM livres
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    "id"=>$idLivre

]);

$livre = $stmt->fetch(PDO::FETCH_ASSOC);


// Vérifier que le livre existe


if(!$livre){

    header("Location: livres.php");

    exit();

}


// Traitement du formulaire


$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST["titre"]);
    $auteur = trim($_POST["auteur"]);
    $maison = trim($_POST["maison_edition"]);
    $nombre = (int) $_POST["nombre_exemplaire"];
    $description = trim($_POST["description"]);

    // Conserver les anciens fichiers
$image = $livre["image"];
$pdf = $livre["fichier_pdf"];

// Nouvelle image
if (!empty($_FILES["image"]["name"])) {

    $nouvelleImage = televerserImage($_FILES["image"]);

    if ($nouvelleImage) {

        if (file_exists("../" . $image)) {
            unlink("../" . $image);
        }

        $image = $nouvelleImage;
    }
}

// Nouveau PDF
if (!empty($_FILES["fichier_pdf"]["name"])) {

    $nouveauPdf = televerserPDF($_FILES["fichier_pdf"]);

    if ($nouveauPdf) {

        if (file_exists("../" . $pdf)) {
            unlink("../" . $pdf);
        }

        $pdf = $nouveauPdf;
    }
}

    // Vérifier les champs

    if (
        empty($titre) ||
        empty($auteur) ||
        empty($maison) ||
        empty($description)
    ) {

        $message = "Veuillez remplir tous les champs.";

    } else {

        // Mise à jour des informations

        $sql = "UPDATE livres SET

        titre=:titre,
        auteur=:auteur,
        maison_edition=:maison,
        nombre_exemplaire=:nombre,
        description=:description,
        image=:image,
        fichier_pdf=:pdf

        WHERE id=:id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([

            "titre" => $titre,
            "auteur" => $auteur,
            "maison" => $maison,
            "nombre" => $nombre,
            "description" => $description,
            "id" => $idLivre,
            "image"=>$image,
            "pdf"=>$pdf

        ]);

        header("Location: livres.php");

        exit();

    }

}


?>

<main class="container">

<h1>Modifier un livre</h1>

<?php if(!empty($message)): ?>

    <p class="warning">

        <?= htmlspecialchars($message) ?>

    </p>

<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="titre"
value="<?= htmlspecialchars($livre["titre"]) ?>"
required
>

<input
type="text"
name="auteur"
value="<?= htmlspecialchars($livre["auteur"]) ?>"
required
>

<input
type="text"
name="maison_edition"
value="<?= htmlspecialchars($livre["maison_edition"]) ?>"
required
>

<input
type="number"
name="nombre_exemplaire"
value="<?= $livre["nombre_exemplaire"] ?>"
required
>

<textarea
name="description"
rows="8"
required><?= htmlspecialchars($livre["description"]) ?></textarea>

<p>

Couverture actuelle

</p>

<img

src="<?= BASE_URL . $livre["image"] ?>"

class="book-cover"

>

<label>

Nouvelle couverture

</label>

<input

type="file"

name="image"

accept=".jpg,.jpeg,.png,.webp"

>

<label>

Nouveau PDF

</label>

<input

type="file"

name="fichier_pdf"

accept=".pdf"

>

<button>

Enregistrer les modifications

</button>

</form>

</main>

<?php require_once "../includes/footer.php"; ?>