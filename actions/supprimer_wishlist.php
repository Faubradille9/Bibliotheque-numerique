<?php


// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/auth.php";


// Vérifier la connexion


redirigerSiNonConnecte();


// Vérifier l'identifiant du livre


if (!isset($_GET["id"]) || empty($_GET["id"])) {

    header("Location: " . BASE_URL . "wishlist.php");
    exit();

}

$idLivre = (int) $_GET["id"];
$idLecteur = $_SESSION["lecteur"]["id"];


// Supprimer le livre de la wishlist


$sql = "DELETE FROM liste_lecture
        WHERE id_livre = :id_livre
        AND id_lecteur = :id_lecteur";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    "id_livre" => $idLivre,
    "id_lecteur" => $idLecteur
]);


// Retour vers la wishlist


header("Location: ../wishlist.php?message=supprime");
exit();