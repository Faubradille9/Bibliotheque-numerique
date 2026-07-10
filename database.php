<?php

$host = 'localhost';
$dbname = 'bibliotheque';
$user = 'root';
$password = '';


try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user , $password);
    $pdo -> setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
}

catch(PDOExecption $e){
    die('Echec de connexion: ' .$e->getMessage());
}



?>