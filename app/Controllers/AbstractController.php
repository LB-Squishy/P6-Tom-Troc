<?php

namespace App\Controllers;

use App\Services\{DBConnect, View};

class AbstractController
{
    protected $db;

    /**
     * Constructeur de la classe.
     * Il récupère automatiquement l'instance de DBConnect. 
     */
    public function __construct()
    {
        $this->db = DBConnect::getInstance();
    }

    /**
     * Rend une Vue. 
     * @param string $viewPath : le nom de la vue. 
     * @param array $params : les paramètres que le controlleur a envoyé à la vue.
     * @param string $title : le titre de la page
     * @return string
     */
    public function render(string $viewName, array $params = [], string $title = ""): void
    {
        $view = new View($title);
        $view->renderView($viewName, $params);
    }

    /**
     * Redirige vers une URL.
     * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
     * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
     * @return void
     */
    public static function redirect(string $action, array $params = []): void
    {
        $url = "index.php?action=$action";
        foreach ($params as $paramName => $paramValue) {
            $url .= "&$paramName=$paramValue";
        }
        header("Location: $url");
        exit();
    }

    /**
     * Redirige avec un message d'erreur
     * @param string $type : type de message (success ou error)
     * @param string $message : le message d'erreur.
     * @param string $location : Route de redirection
     * @return void
     */
    public static function redirectWithMessage(string $type, string $message, string $location): void
    {
        $_SESSION[$type] = $message;
        header("Location: $location");
        exit();
    }

    /**
     * Vérifie si l'utilisateur est connecté
     * @return mixed : L'user ou null si non connecté
     */
    protected function checkUser(): mixed
    {
        $user = $_SESSION["user"] ?? null;
        if (!$user) {
            $this->redirectWithMessage('error', 'Utilisateur non connecté. Merci de vous connecter afin de pouvoir accéder à votre espace.', '/connexion');
        }
        return $user;
    }

    /**
     * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
     * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
     * ou celle qui est passée en paramètre si elle existe.
     * @param string $variableName : le nom de la variable à récupérer.
     * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
     * @return mixed : la valeur de la variable ou la valeur par défaut.
     */
    public static function request(string $variableName, mixed $defaultValue = null): mixed
    {
        return $_REQUEST[$variableName] ?? $defaultValue;
    }
}
