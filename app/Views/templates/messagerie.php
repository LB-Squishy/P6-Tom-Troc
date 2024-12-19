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
                <a class="chat-section__card <?= (isset($currentChat) && $currentChat == urlencode($chat->getId()) ? 'chat-section__card--active' : '') ?>" href="/messagerie/?chat_id=<?= urlencode($chat->getId()) ?>">
                    <img class="chat-section__card--miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($chat->getParticipantMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                    <div class="chat-section__card--container">
                        <div class="chat-section__card--texte-container">
                            <p class="chat-section__card--pseudo"><?= htmlspecialchars($chat->getParticipantPseudo(), ENT_QUOTES, 'UTF-8') ?></p>
                            <p class="chat-section__card--heure"><?= htmlspecialchars((new DateTime($chat->getDateCreation()))->format('H:i'), ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="chat-section__card--message-container">
                            <p class="chat-section__card--message"><?= htmlspecialchars($chat->getLastMessage(), ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
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
                <p class="message-section__header--pseudo"><?= htmlspecialchars($chat->getParticipantPseudo(), ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div class="message-section__chat-box">
                <div class="message-section__chat-box--message-container">
                    <?php foreach ($messages as $index => $message): ?>
                        <div class="<?= ($index % 2 == 0) ? 'message-section__chat-box--container-right' : 'message-section__chat-box--container-left' ?>">
                            <div class="message-section__chat-box--header-container">
                                <img class="message-section__chat-box--miniature" src="<?= PROFILE_IMAGE_PATH . htmlspecialchars($message->getSenderMiniature(), ENT_QUOTES, 'UTF-8') ?>" alt="Miniature" />
                                <p class="message-section__chat-box--date"><?= htmlspecialchars((new DateTime($message->getDateEnvoi()))->format('d.m H:i'), ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                            <div class="<?= ($index % 2 == 0) ? 'message-section__chat-box--message-right' : 'message-section__chat-box--message-left' ?>">
                                <p><?= htmlspecialchars($message->getMessage(), ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="message-section__new-message">
                <form class="message-section__new-message--form">
                    <textarea class="message-section__new-message--texte form-control" name="new-message" id=""></textarea>
                    <button class="btn btn-primary message-section__new-message--btn">Envoyer</button>
                </form>
            </div>
        <?php else: ?>
            <p>Selectionnez un de vos contact afin de poursuivre vos échanges.</p>
        <?php endif; ?>
    </section>
</div>