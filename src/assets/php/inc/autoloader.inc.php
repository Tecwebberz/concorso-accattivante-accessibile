<?php

/*
Per attivare l'autoloading delle classi specifiche richieste aggiungere la seguente linea di codice al file che ha bisogno di questa funzionalità

    include 'includes/autoloader.inc.php';
*/

spl_autoload_register('AutoLoader');

function AutoLoader($className){
    $path = "classes/";
    $extension = ".class.php";

    $fullPath = $path . $className . $extension;

    if(!file_exists($fullPath)){
        return false;
    }

    include_once $fullPath;
}
