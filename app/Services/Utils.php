<?php

namespace App\Services;

/**
 * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
 * directement sans avoir besoin d'instancier un objet Utils.
 * Exemple : Utils::redirect('home'); 
 */

class Utils
{
    // Valide le format et les dimensions d'une photo de profil
    public static function validatePhoto($photo)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        $badType = !in_array($photo['type'], $allowedTypes);
        $badSize = $photo['size'] > $maxSize;

        if ($badType && $badSize) {
            return 'Merci de mettre une photo de type jpeg, png ou webp, et de ne pas dépasser les 1024px par 1024px.';
        }

        if ($badType) {
            return 'Merci de mettre une photo de type jpeg, png ou webp.';
        }

        if ($badSize) {
            return 'Merci de sélectionner une photo qui ne dépasse pas les 1024px par 1024px.';
        }

        return true;
    }
}
