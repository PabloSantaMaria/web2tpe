<?php
class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home',
        'home' => 'NavController#home',
        'cotizaciones' => 'AccionesController#getAcciones',
        'operar' => 'NavController#operar',
        'acerca' => 'NavController#acerca',
        'agregar' => 'AccionesController#insert',
        'borrar' => 'AccionesController#delete',
        'completada' => 'AccionesController#update'
    ];
}
?>