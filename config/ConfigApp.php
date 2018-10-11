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
        'editar' => 'AccionesController#editar',
        'updateRegistro' => 'AccionesController#updateRegistro',
        'borrar' => 'AccionesController#deleteAccion',
    ];
}
?>