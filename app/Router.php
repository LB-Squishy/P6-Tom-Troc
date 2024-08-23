<?php

require_once  'Controllers/PageController.php';
require_once  'Controllers/BookController.php';
require_once  'Services/Utils.php';
require_once  'config/config.php';

/**
 * Classe router : cette classe est res^ponsable de la gestion des routes et de la
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
                    (new PageController())->showHome();
                    break;
                case 'books':
                    (new BookController())->showBooks();
                    break;
                default:
                    (new PageController())->showNotFound();
                    break;
            }
        } catch (Exception $e) {
            // En cas d'erreur, on affiche la page d'erreur.
            $errorView = new View('Erreur');
            $errorView->renderView('errorPage', ['errorMessage' => $e->getMessage()]);
        }
    }
}
