<?php

use App\Services\View;
use App\Controllers\{AbstractController, HomepageController, NotFoundController, BookController, ErrorViewTestController};

require_once  'config/config.php';

/**
 * Classe router : cette classe est responsable de la gestion des routes et de la
 * distribution des actions aux contrôleurs appropriés en fonction de la requête
 * utilisateur.
 */

class Router
{
    /**
     * Cette méthode permet de dispatcher l'action demandée par l'utilisateur.
     * @param string $action : l'action demandée (par défaut "homepage" si aucune action n'est spécifiée).
     */
    public function dispatch()
    {
        // On récupère l'action demandée par l'utilisateur.
        // Si aucune action n'est demandée, on affiche la page d'accueil.
        $action = AbstractController::request('action', 'homepage');

        // Try catch global pour gérer les erreurs
        try {
            // On détermine quelle action effectuer en fonction de la valeur $action
            switch ($action) {
                case 'homepage':
                    (new HomepageController())->showHomepage();
                    break;
                case 'books':
                    (new BookController())->showBooks();
                    break;
                case 'saperlipopette':
                    (new ErrorViewTestController())->showTest();
                    break;
                default:
                    (new NotFoundController())->showNotFound();
                    break;
            }
        } catch (Exception $e) {
            // En cas d'erreur, on affiche la page d'erreur.
            $errorView = new View('Erreur');
            $errorView->renderView('errorPage', ['errorMessage' => $e->getMessage()]);
        }
    }
}
