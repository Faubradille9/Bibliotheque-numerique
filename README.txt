Guide d'installation (Laragon)
Prérequis

Installer :

Laragon
PHP 8 ou supérieur (fourni avec Laragon)
MySQL (fourni avec Laragon)
phpMyAdmin (accessible via Laragon)
Un navigateur web (Chrome, Firefox, Edge...)


Étape 1 : Copier le projet

Copier le dossier du projet dans le répertoire : C:\laragon\www\

Exemple : C:\laragon\www\bibliotheque


Étape 2 : Démarrer Laragon

Lancer Laragon, puis cliquer sur : Start All

Les services Apache et MySQL doivent être en cours d'exécution.

Étape 3 : Créer la base de données
Ouvrir Laragon.
Cliquer sur Menu > MySQL > phpMyAdmin.
Se connecter à phpMyAdmin.
Créer une base de données nommée :bibliotheque
Importer le fichier SQL du projet (ou créer les tables manuellement si nécessaire).

Étape 4 : Configurer la connexion

Dans le fichier : config/database.php

Vérifier les paramètres :

$host = "localhost";
$dbname = "bibliotheque";
$user = "root";
$password = "";

Ce sont les identifiants par défaut de Laragon.

Étape 5 : Vérifier les dossiers d'upload

S'assurer que les dossiers suivants existent et sont accessibles en écriture :assets/images/couvertures/

et uploads/pdf/


Étape 6 : Lancer le projet

Dans le navigateur, accéder à : http://bibliotheque.test

Si le Virtual Host n'est pas configuré, utiliser :http://localhost/bibliotheque

Guide d'utilisation
Lecteur
	Créer un compte.
	Se connecter.
	Rechercher un livre par titre ou auteur.
	Consulter les détails d'un livre.
	Ajouter le livre à la liste de lecture.
	Consulter ou retirer un livre de la liste de lecture.
	Télécharger ou lire le fichier PDF.
Administrateur
	Se connecter avec un compte ayant le rôle admin.
	Accéder au menu Administration.
	Consulter la liste des livres.
	Ajouter un nouveau livre.
	Modifier les informations d'un livre.
	Supprimer un livre devenu indisponible.