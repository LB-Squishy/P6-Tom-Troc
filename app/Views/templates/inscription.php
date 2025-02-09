<?php

/**
 * Template pour afficher la page d'inscription'.
 */
?>

<div class="container-fluid d-flex align-items-center justify-content-center p-0">
    <div class="row w-100 h-100">
        <div class="form-container col-md-6 d-flex flex-column justify-content-center align-items-center p-0">
            <div class="w-100 px-2" style="max-width: 350px;">
                <h1 class="mb-5"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
                <form method="POST" action="/submit-inscription">
                    <div class="mb-3">
                        <label class="form-label" for="pseudo">Pseudo</label>
                        <input class="form-control" id="pseudo" type="text" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Adresse email</label>
                        <input class="form-control" id="email" type="email" name="email" autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Mot de passe</label>
                        <input class="form-control" id="password" type="password" name="password" autocomplete="new-password" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">S'inscrire</button>
                </form>
                <p class="mt-5 mb-0">Déjà inscrit ? <a href="/connexion">Connectez-vous</a></p>
                <?php if (isset($error)) : ?>
                    <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center p-0" style="overflow: hidden; height: calc(100vh - 80px - 60px);">
            <img src="/src/images/connexion.webp" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="image de connexion">
        </div>
    </div>
</div>