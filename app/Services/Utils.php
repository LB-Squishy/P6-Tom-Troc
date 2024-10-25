<?php

namespace App\Services;

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */

class Utils
{
    public static function validatePhoto($photo)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        return in_array($photo['type'], $allowedTypes) && $photo['size'] <= $maxSize;
    }
}
