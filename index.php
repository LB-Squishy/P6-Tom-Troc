<?php

// Démarre la session
session_start();

require_once 'app/Router.php';

// Crée une instance du routeur et fait le dispatch

$router = new Router();
try {
    $router->dispatch();
} catch (Exception $e) {
    // Gestion des erreurs génériques
    (new PageController())->showNotFound();
}
