<?php
    /**
     * Affichage de la messagerie. 
     */
?>
<section class="messaging">
    <div class="messaging_owner">
        <h1 class="messaging_owner_title">Messagerie</h1>
        <div class="messaging_owner_interlocutors">
            <?php
            foreach ($conversations as $conversation) { ?>
                <a href="index.php?action=messaging&id=<?= $conversation->getInterlocutor()->getId() ?>">
                <div class="d-flex <?= isset ($_GET['id']) && $conversation->getInterlocutor()->getId() == $_GET['id'] ? 'bg-white' : 'messaging_owner_interlocutors_line d-flex'?>">
                    <img src="<?= $conversation->getInterlocutor()->getPicture() ?>" alt="<?= $conversation->getInterlocutor()->getPseudo() ?>">
                    <div class="messaging_owner_interlocutors_content">
                        <div class="messaging_owner_interlocutors_title d-flex align-center">
                            <div class="d-flex align-center">
                                <p><?= $conversation->getInterlocutor()->getPseudo() ?></p>
                                <?php if ($conversation->getUnreadMessagesCount() > 0) { ?>
                                    <span class="messaging_owner_interlocutors_title_count"><?= $conversation->getUnreadMessagesCount() ?></span>
                                <?php } ?>
                            </div>
                            <span><?= Utils::convertDateFormatShort($conversation->getLastMessage()->getDateCreation()) ?></span>
                        </div>
                        <p class="messaging_owner_interlocutors_content_msg"><?= $conversation->getLastMessage()->getContent(28) ?></p>
                    </div>
                </div>
                </a>   
            <?php } ?>
        </div>
    </div>

    <div class="messaging_conversation d-flex flex-column">
        <!-- Afficher les messages entre utilisateurs -->
        <?php if (!isset($_GET['id'])) { ?>
            <span class="messaging_conversation_empty">Sélectionnez un interlocuteur pour visualiser la conversation</span>
        <?php } else { ?>
            <a href="index.php?action=messaging" class="back">
                &larr; retour
            </a>
            <div class="messaging_conversation_intrerlocutor d-flex">
                <img class="messaging_conversation_intrerlocutor_img" src="<?= $interlocutor->getPicture() ?>" alt="<?= $interlocutor->getPseudo() ?>">
                <h2><?= $interlocutor->getPseudo() ?></h2>
            </div>
            <div class="messaging_conversation_messages">
                <?php foreach ($messages as $message) { ?>
                    <div class="d-flex flex-column" >
                        <div class="d-flex align-center">
                            <?php if ($message->getSender() === $interlocutor->getId()) { ?>
                                <img src="<?= $interlocutor->getPicture() ?>" alt="<?= $interlocutor->getPseudo() ?>">
                            <?php } ?>
                            <span class="messaging_conversation_messages_date <?= $message->getSender() === $_SESSION['idUser'] ? 'messaging_conversation_messages_date_user' : '' ?>"> <?= ucfirst(Utils::convertDateFormatLong($message->getDateCreation())) ?></span>
                        </div>
                        <p class="messaging_conversation_messages_content <?= $message->getSender() === $_SESSION['idUser'] ? 'messaging_conversation_messages_content_user' : '' ?>"><?= $message->getContent() ?></p>
                    </div>
                <?php } ?>
            </div>
            <form action="index.php?action=sendMessage" method="post">
                <input type="hidden" name="receiver" value="<?= $interlocutor->getId() ?>">
                <div>
                    <input class="messaging_conversation_text" type="text" name="content" placeholder="Tapez votre message ici">
                    <button type="submit" class="button">Envoyer</button>
                </div>    
            </form>
        <?php } ?>
    </div>
</section>