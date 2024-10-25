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
    <script src="https://kit.fontawesome.com/749a47ec2c.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@400;700" rel="stylesheet">
    <link rel="stylesheet" href="../../src/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <?php include "./app/Views/components/layout/header.php"; ?>

    <!-- Affichage des messages d'erreur et de succès -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']);
        ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['success']);
        ?>
    <?php endif; ?>

    <!-- Affichage du contenu de la page -->
    <main>
        <?= $content ?>
    </main>

    <?php include "./app/Views/components/layout/footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="/src/js/modalePhoto.js"></script>
    <script src="/src/js/modaleConfirmation.js"></script>

</body>

</html>