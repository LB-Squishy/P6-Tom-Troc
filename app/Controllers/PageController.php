<?php

require_once __DIR__ . '/../Services/View.php';

class PageController
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome(): void
    {
        $view = new View('Accueil');
        $view->render('homepage', []);
    }

    /**
     * Affiche les livres.
     * @return void
     */
    public function showBooks(): void
    {
        $view = new View('Livres');
        $view->render('books', []);
    }

    /**
     * Affiche la page d'erreur 404.
     * @return void
     */
    public function showNotFound(): void
    {
        $view = new View('Erreur 404');
        $view->render('error404', []);
    }
}
