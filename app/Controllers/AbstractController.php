<?php

require_once __DIR__ . '/../Services/View.php';
require_once __DIR__ . '/../Services/DBConnect.php';

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
