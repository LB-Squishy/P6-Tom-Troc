<?php

use App\Services\View;
use App\Controllers\{AbstractController, AccueilController, NosLivresController, LivreController, ComptePublicController, ConnexionController, InscriptionController, MessagerieController, MonCompteController, EditionLivreController, NotFoundController};

require_once  'config/config.php';

/**
 * Classe router : cette classe est responsable de la gestion des routes et de la
 * distribution des actions aux contrôleurs appropriés en fonction de la requête.
 */

class Router
{
    /**
     * Méthode qui dispatch l'action demandée par l'utilisateur.
     * @param string $action : l'action demandée (par défaut "accueil" si aucune action n'est spécifiée).
     * @param string $pseudo : le pseudo demandé.
     */
    public function dispatch()
    {
        // On récupère l'action demandée par l'utilisateur.
        // Si aucune action n'est demandée, on affiche la page d'accueil.
        $action = rtrim(AbstractController::request('action', 'accueil'), '/');

        // On récupère le pseudo demandée par l'utilisateur.
        $pseudo =  AbstractController::request('pseudo', null);

        // On détermine quelle action effectuer en fonction de la valeur $action
        switch ($action) {
            case 'accueil':
                (new AccueilController())->showAccueil();
                break;
            case 'nos-livres':
                (new NosLivresController())->showNosLivres();
                break;
            case 'livre':
                (new LivreController())->showLivre();
                break;
            case 'compte-public':
                if ($pseudo) {
                    (new ComptePublicController())->showComptePublic($pseudo);
                } else {
                    (new NotFoundController())->showNotFound();
                }
                break;
            case 'connexion':
                (new ConnexionController())->showConnexion();
                break;
            case 'submit-connexion':
                (new ConnexionController())->connexion();
                break;
            case 'deconnexion':
                (new ConnexionController())->deconnexion();
                break;
            case 'inscription':
                (new InscriptionController())->showInscription();
                break;
            case 'submit-inscription':
                (new InscriptionController())->inscription();
                break;
            case 'messagerie':
                (new MessagerieController())->showMessagerie();
                break;
            case 'mon-compte':
                (new MonCompteController())->showMonCompte();
                break;
            case 'mon-compte/edit-miniature':
                (new MonCompteController())->editMiniature();
                break;
            case 'mon-compte/maj-infos-utilisateur':
                (new MonCompteController())->majInfosUtilisateur();
                break;
            case 'mon-compte/disponibilite-livre':
                (new MonCompteController())->toggleDisponibiliteLivre();
                break;
            case 'mon-compte/suppression-livre':
                (new MonCompteController())->deleteLivre();
                break;
            case 'edition-livre':
                (new EditionLivreController())->showEditionLivre();
                break;
            default:
                (new NotFoundController())->showNotFound();
                break;
        }
    }
}
