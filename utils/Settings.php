<?php

/**
* Clase Settings.
* 
* Contiene variables para configurar la aplicación.
* 
* @property boolean $maintenance_mode Define si la aplicación está en modo de mantenimiento o no. Por defecto, es false.
* @property string $base_route Define la ruta base de la aplicación. Por defecto, es '/crud/'.
*/
class Settings {
    
    /**
    * Define si la aplicación está en modo de mantenimiento o no.
    *
    * @var boolean
    */
    public $maintenance_mode = false;

    /**
    * Define la ruta base de la aplicación.
    *
    * @var string
    */
    public $base_route = '/crud/';

}

?>