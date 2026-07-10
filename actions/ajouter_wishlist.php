<?php


// Connexion


require_once "../config/database.php";
require_once "../includes/header.php";
require_once "../includes/auth.php";


// Vérifier la connexion


redirigerSiNonConnecte();


// Vérifier l'identifiant du livre


if (!isset($_GET["id"])) {

    header("Location: " . BASE_URL);
    exit();

}

$idLivre = (int) $_GET["id"];
$idLecteur = $_SESSION["lecteur"]["id"];


// Vérifier si le livre est déjà dans la wishlist


$sql = "SELECT * FROM liste_lecture
        WHERE id_livre = :id_livre
        AND id_lecteur = :id_lecteur";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    "id_livre" => $idLivre,
    "id_lecteur" => $idLecteur

]);


// Si le livre existe déjà


if ($stmt->rowCount() > 0) {

    header("Location: ../details.php?id=$idLivre&message=existe");
    exit();

}


// Ajouter le livre


$sql = "INSERT INTO liste_lecture(id_livre,id_lecteur,date_ajout)

        VALUES(:id_livre,:id_lecteur,CURDATE())";

$stmt = $pdo->prepare($sql);

$stmt->execute([

    "id_livre"=>$idLivre,
    "id_lecteur"=>$idLecteur

]);


// Retour


header("Location: ../details.php?id=$idLivre&message=ajoute");
exit();