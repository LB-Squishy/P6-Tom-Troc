<?php

use App\Controllers\NotFoundController;

require_once 'config/autoload.php';
require_once 'app/Router.php';

// Démarre la session
session_start();

// Crée une instance du routeur et fait le dispatch
$router = new Router();
try {
    $router->dispatch();
} catch (Exception $e) {
    // Gestion des erreurs génériques
    (new NotFoundController())->showNotFound();
}
