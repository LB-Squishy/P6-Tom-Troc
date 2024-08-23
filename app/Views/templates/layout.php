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
    <meta name="description" content="Tom Troc : Site d'échange de livre entre passionnés">
    <title><?= htmlspecialchars($title ?? 'Tom Troc') ?></title>
    <link rel="stylesheet" href="../../src/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <?php include "./app/Views/components/header.php"; ?>

    <main>
        <?= $content /* Ici est affiché le contenu généré de la page. */ ?>
    </main>

    <?php include "./app/Views/components/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>