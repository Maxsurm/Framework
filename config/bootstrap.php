<?php

use Dotenv\Dotenv;

// ------------------------------------------------------------------------------------------------

// Bootstrap

// Chargement des fichier de configuration
// ------------------------------------------------------------------------------------------------

// Chargement de l'autoloader
require_once dirname(__DIR__) . "/vendor/autoload.php";

// Chargement des variables d'environnement
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Chargement du conteneur de dépendances
require_once __DIR__ . "/dependenciesInjection/container.php";