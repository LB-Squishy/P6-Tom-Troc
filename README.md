[![forthebadge](https://forthebadge.com/images/badges/powered-by-coffee.svg)](https://forthebadge.com)

# Mettre en place un site de mise en relation avec PHP

## Contenu:

Vous êtes embauché par TomTroc, une association à but non lucratif dont le but est d’encourager le partage des livres et de créer des rencontres entre lecteurs.

L’association vise à mettre en relation des particuliers qui souhaitent échanger des livres afin de donner une seconde vie aux livres qui ne sont plus utilisés. Son objectif est de créer une plateforme conviviale où les membres peuvent facilement se connecter, communiquer et organiser des échanges de livres en toute simplicité.

## Technologie:

-   PHP
-   Pattern MVC
-   Orienté Objet
-   SCSS

## Pour utiliser ce projet :

-   Commencer par cloner le projet.
-   installez le projet chez vous, dans un dossier exécuté par un serveur local (type MAMP, WAMP, LAMP, etc...)
-   Une fois installé chez vous, créez un base de données vide appelée : "tom_troc"
-   Importez le fichier tom_troc.sql dans votre base de données.

## Lancez le projet !

Pour la configuration du projet renomez le fichier _\_config.php_ (dans le dossier _config_) en _config.php_ et éditez le si nécessaire.

## Pour SCSS :

-   Installez sass si ce n est pas fais : npm install -g sass
-   pour la compilation automatique saisissez la commande : sass --watch src/scss/main.scss:src/css/style.css
-   En cas d'ajout de fichier scss, pensez à les importer dans main.scss
