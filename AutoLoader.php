<?php
    spl_autoload_register('autoload');
    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    function autoload(string $class) : void{
        require_once join('\\', array_slice(explode('\\', $class), 1)) .'.php';
    }
