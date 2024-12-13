<?php

/**
 * Template pour afficher la page d'accueil'.
 */
?>

<div class="messagerie-container">
    <section class="chat-section">
        <h1 class="chat-section__title"><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>
        <?php if (!empty($chats)): ?>
            <?php foreach ($chats as $chat): ?>
                <a class="chat-section__card" href="/messagerie/?chat_id=<?= urlencode($chat->getId()) ?>">
                    <img class="chat-section__card--miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($chat->getParticipantMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                    <p><?= htmlspecialchars($chat->getParticipantPseudo(), ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= htmlspecialchars($chat->getDateCreation(), ENT_QUOTES, 'UTF-8') ?></p>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Vous n'avez pas de conversation en cours.</p>
        <?php endif; ?>
    </section>
    <section class="message-section">
        <?php if (!empty($messages)): ?>
            <div class="message-section__header">
                <img class="message-section__header--miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($chat->getParticipantMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                <p><?= htmlspecialchars($chat->getOwnerPseudo(), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <?php foreach ($messages as $message): ?>
                <div class="message-section__chat-box">
                    <img src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($message->getSenderMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                    <p><?= htmlspecialchars($message->getDateEnvoi(), ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= htmlspecialchars($message->getMessage(), ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Vous n'avez pas de conversation en cours.</p>
        <?php endif; ?>
    </section>
</div>