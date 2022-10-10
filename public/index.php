<?php 

use App\Kernel;

/**
*------------------------------------------------------------------------------------------------
*
*Bienvenue dans notre Framework fait maison 
*L'index.php est le "FrontController
*
*Ses roles : 
*-Réaliser le Bootstapping de l'application 
*    C'est à dire charger tout ce dont l'application a besoin pour fonctionner
*-Créer une nouvelle instance du noyau en lui passant le conteneur de dépendances
*-Demander au noyau de soumettre la request au système et de recuperer la réponse correspondante
*-Envoyer cette reponse au client
*------------------------------------------------------------------------------------------------
*/

//chargement du fichier de configuration
require_once dirname(__DIR__) . "/config/bootstrap.php";

// Création d'une nouvelle instance du noyau
$kernel = new Kernel($container);

/**
 * Le FrontController demande au noyau de :
 *      -soummettre la requete
 *      -recuperer la réponse correspondante
 */
$response = $kernel->handleRequest();

/**
 * Envoie de la reponse au client
 */
$response->send();