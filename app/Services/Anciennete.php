<?php
// Services/DateService.php

/**
 * Calcule l'ancienneté en années et mois à partir d'une date donnée.
 *
 * @param string $dateInscription Date d'inscription au format 'Y-m-d H:i:s'.
 * @return string Ancienneté sous la forme 'X an(s) et Y mois'.
 */
function calculerAnciennete($dateInscription)
{
    $dateInscription = new DateTime($dateInscription);
    $aujourdhui = new DateTime();

    $difference = $dateInscription->diff($aujourdhui);

    $annees = $difference->y;
    $mois = $difference->m;

    $anciennete = '';
    if ($annees > 0) {
        $anciennete .= $annees . ' an' . ($annees > 1 ? 's' : '');
    }
    if ($mois > 0) {
        if ($anciennete !== '') {
            $anciennete .= ' et ';
        }
        $anciennete .= $mois . ' mois';
    }

    return $anciennete ?: 'Moins d\'un mois';
}
