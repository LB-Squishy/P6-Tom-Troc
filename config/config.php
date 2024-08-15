<?php
    // En fonction des routes utilisées, il est possible d'avoir besoin de la session ; on la démarre dans tous les cas. 
    session_start();

    // Ici on met les constantes utiles, 
    // les données de connexions à la bdd
    // et tout ce qui sert à configurer. 
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'tom_troc');
    define('DB_USER', 'root');
    define('DB_PASS', '');