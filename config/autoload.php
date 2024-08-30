<?php

/**
 * Système d'autoload. 
 */

spl_autoload_register(function (string $class): void {
    // var_dump($class);
    // Définir le répertoire de base
    $baseDir = dirname(__DIR__) . '/';

    // Remplacer les backslashes par des slashes pour le chemin de fichier
    $classPath = str_replace(['\\', 'App'], ['/', 'app'], $class);

    // Construction du chemin complet du fichier
    $filepath = $baseDir . $classPath . '.php';

    // var_dump($filepath);

    if (file_exists($filepath)) {
        require_once $filepath;
    } else {
        throw new Exception("Fichier « " . $filepath . " » introuvable pour la classe « " . $class . " ». Vérifiez le chemin, le nom de la classe ou le namespace.");
    }
});
