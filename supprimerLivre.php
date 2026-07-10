<?php

require_once "../config/database.php";
require_once "../includes/auth.php";

redirigerSiNonAdmin();

if(!isset($_GET["id"])){

    header("Location: livres.php");
    exit();

}

$id = (int)$_GET["id"];

// récupérer le livre

$sql="SELECT * FROM livres WHERE id=:id";

$stmt=$pdo->prepare($sql);

$stmt->execute([
    "id"=>$id
]);

$livre=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$livre){

    header("Location: livres.php");
    exit();

}

// supprimer les fichiers

if(file_exists("../".$livre["image"])){

    unlink("../".$livre["image"]);

}

if(file_exists("../".$livre["fichier_pdf"])){

    unlink("../".$livre["fichier_pdf"]);

}

// supprimer le livre

$sql="DELETE FROM livres WHERE id=:id";

$stmt=$pdo->prepare($sql);

$stmt->execute([
    "id"=>$id
]);

header("Location: livres.php");

exit();