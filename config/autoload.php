<?php

/**
 * Système d'autoload. 
 * A chaque fois que PHP va avoir besoin d'une classe, il va appeler cette fonction 
 * et chercher dnas les divers dossiers (ici models, controllers, views, services) s'il trouve 
 * un fichier avec le bon nom. Si c'est le cas, il l'inclut avec require_once.
 */
spl_autoload_register(function($className) {
    // On va voir dans le dossier Service si la classe existe.
    if (file_exists('src/services/' . $className . '.php')) {
        require_once 'src/services/' . $className . '.php';

    }

    // On va voir dans le dossier Entities si la classe existe.
    if (file_exists('src/entities/' . $className . '.php')) {
        require_once 'src/entities/' . $className . '.php';
    }

    // On va voir dans le dossier Manager si la classe existe.
    if (file_exists('src/managers/' . $className . '.php')) {
        require_once 'src/managers/' . $className . '.php';
    }
    

    // On va voir dans le dossier Controller si la classe existe.
    if (file_exists('src/controllers/' . $className . '.php')) {
        require_once 'src/controllers/' . $className . '.php';
    }

    // On va voir dans le dossier View si la classe existe.
    if (file_exists('src/views/' . $className . '.php')) {
        require_once 'src/views/' . $className . '.php';
    }    
});