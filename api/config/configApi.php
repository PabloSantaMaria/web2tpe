<?php

class ConfigApi {
    public static $DB = array(
        'dbms' => 'mysql',
        'host' => 'localhost',
        'dbname' => 'tabrokers',
        'username' => 'root',
        'password' => ''
    );
    public static $RESOURCE = 'resource';
    public static $PARAMS = 'params';
    public static $RESOURCES = [
        'accion#GET' => 'ApiController#detalleAccion', //ver detalle de acción
    ];
}