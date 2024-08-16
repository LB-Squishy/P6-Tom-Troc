<?php

/**
 * Ce fichier est le layout principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 * $title string : le titre de la page.
 * $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Tom Troc') ?></title>
    <link rel="stylesheet" href="../../src/css/style.css">
</head>

<body>

    <?php include "./app/Views/components/header.php"; ?>

    <main>
        <?= $content /* Ici est affiché le contenu généré de la page. */ ?>
    </main>

    <?php include "./app/Views/components/footer.php"; ?>

</body>

</html>