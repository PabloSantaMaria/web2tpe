<?php
class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home',
        'home' => 'NavController#home',
        'cotizaciones' => 'NavController#cotizaciones',
        'operar' => 'NavController#operar',
        'acerca' => 'NavController#acerca',
        'borrar' => 'AccionesController#deleteAccion',
        'agregar' => 'AccionesController#insert',
        'completada' => 'AccionesController#update'
    ];
}
?>