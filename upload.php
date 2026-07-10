<?php

/**
 * Téléverse une image.

 */
function televerserImage($fichier)
{
    // Vérifier qu'un fichier a été envoyé
    if ($fichier["error"] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Extensions autorisées
    $extensionsAutorisees = ["jpg", "jpeg", "png", "webp"];

    // Récupérer l'extension
    $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));

    // Vérifier l'extension
    if (!in_array($extension, $extensionsAutorisees)) {
        return false;
    }

    // Générer un nom unique
    $nomFichier = uniqid("img_") . "." . $extension;

    // Destination
    $destination = "../assets/images/couvertures/" . $nomFichier;

    // Déplacer le fichier
    if (move_uploaded_file($fichier["tmp_name"], $destination)) {

        return "assets/images/couvertures/" . $nomFichier;

    }

    return false;
}



/**
 * Téléverse un PDF.
 *
 * @param array $fichier
 * @return string|false
 */
function televerserPDF($fichier)
{

    if ($fichier["error"] !== UPLOAD_ERR_OK) {
        return false;
    }

    $extension = strtolower(pathinfo($fichier["name"], PATHINFO_EXTENSION));

    if ($extension !== "pdf") {
        return false;
    }

    $nomFichier = uniqid("pdf_") . ".pdf";

    $destination = "../uploads/pdf/" . $nomFichier;

    if (move_uploaded_file($fichier["tmp_name"], $destination)) {

        return "uploads/pdf/" . $nomFichier;

    }

    return false;

}