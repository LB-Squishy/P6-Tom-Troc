<?php

/**
 * LAYOUT PRINCIPAL
 */

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tom Troc : Site d'échange de livre entre passionnés">
    <title><?= htmlspecialchars($title ?? 'Tom Troc') ?></title>
    <script src="https://kit.fontawesome.com/749a47ec2c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:wght@400;700" rel="stylesheet">
    <link rel="stylesheet" href="../../src/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <!-- Affichage du header -->
    <?php include "./app/Views/components/layout/header.php"; ?>
    <!-- Affichage du message d'erreur ou de success -->
    <?php include "./app/Views/components/error.php"; ?>
    <!-- Affichage du contenu de la page -->
    <main> <?= $content ?> </main>
    <!-- Affichage du footer -->
    <?php include "./app/Views/components/layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script type="module" src="/src/js/alerteTimer.js"></script>
    <script type="module" src="/src/js/modals.js"></script>

</body>

</html>