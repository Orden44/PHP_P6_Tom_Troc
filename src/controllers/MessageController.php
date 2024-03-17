<?php

class MessageController
{
     /**
     * Affiche la page messagerie.
     * @return void
     */
    public function showMessaging(): void
    {
        $view = new View("Messagerie");
        $view->render("messaging");

    }
}