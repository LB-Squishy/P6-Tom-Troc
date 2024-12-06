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

        list($width, $height) = @getimagesize($photo['tmp_name']);
        $badDimensions = $width > 1024 || $height > 1024;

        if ($badType && $badSize && $badDimensions) {
            return 'Merci de mettre une photo de type jpeg, png ou webp, et de ne pas dépasser 1024px par 1024px.';
        }

        if ($badType) {
            return 'Merci de mettre une photo de type jpeg, png ou webp.';
        }

        if ($badSize) {
            return 'Merci de sélectionner une photo qui ne dépasse pas 2 Mo.';
        }

        if ($badDimensions) {
            return 'Merci de sélectionner une photo qui ne dépasse pas 1024px par 1024px.';
        }

        return true;
    }

    // Valide le format et les dimensions d'une couverture de livre
    public static function validateCover($cover)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $maxSize = 2 * 1024 * 1024; // 2 MB

        $badType = !in_array($cover['type'], $allowedTypes);
        $badSize = $cover['size'] > $maxSize;

        list($width, $height) = @getimagesize($cover['tmp_name']);
        $badDimensions = $width > 1024 || $height > 1024;

        if ($badType && $badSize && $badDimensions) {
            return 'Merci de mettre une photo de couverture de type jpeg, png ou webp, et de ne pas dépasser 1024px par 1024px.';
        }

        if ($badType) {
            return 'Merci de mettre une photo de couverture de type jpeg, png ou webp.';
        }

        if ($badSize) {
            return 'Merci de sélectionner une photo de couverture qui ne dépasse pas 2 Mo.';
        }

        if ($badDimensions) {
            return 'Merci de sélectionner une photo de couverture qui ne dépasse pas 1024px par 1024px.';
        }

        return true;
    }
}
