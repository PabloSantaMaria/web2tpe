<?php
class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home',
        'home' => 'NavController#home',
        'operar' => 'NavController#operar',
        'acerca' => 'NavController#acerca',
        'acciones' => 'AccionesController#getAcciones',
        'cotizaciones' => 'AccionesController#getRegion',
        'borrar' => 'AccionesController#deleteAccion',
        'agregar' => 'AccionesController#insert',
        'completada' => 'AccionesController#update'
    ];
}
?>