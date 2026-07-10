<?php


function estConnecte()
{
    return isset($_SESSION["lecteur"]);
}


/*
  Redirige l'utilisateur vers la page de connexion s'il n'est pas connecté.
 */
function redirigerSiNonConnecte()
{
    if (!estConnecte()) {

        header("Location: " . BASE_URL . "auth/connexion.php");
        exit();

    }
}

/*Verifie si l'utilisateur connecte est un administrateur
 */
function estAdmin()
{
    return estConnecte() &&
           $_SESSION["lecteur"]["role"] === "admin";
}


/**
 * Protège une page réservée aux administrateurs.
 */
function redirigerSiNonAdmin()
{
    if (!estAdmin()) {

        header("Location: " . BASE_URL);
        exit();

    }
}

?>