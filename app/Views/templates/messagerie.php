<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<div class="container">
    <h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
    <a class="btn btn-primary" href="/accueil" role="button">Accueil</a>
    <div class="messagerie">
        <h2>Mes Conversations</h2>
        <?php if (!empty($chats)): ?>
            <ul>
                <?php foreach ($chats as $chat): ?>
                    <li>
                        <img src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($chat->getParticipantMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                        <span><?= htmlspecialchars($chat->getParticipantPseudo(), ENT_QUOTES, 'UTF-8') ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune conversation disponible.</p>
        <?php endif; ?>
    </div>
</div>