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
        'acciones' => 'AccionesController#getAll',
        'cotizaciones' => 'AccionesController#getRegion',
        'editar' => 'AccionesController#editAccion',
        'actualizar' => 'AccionesController#updateAccion',
        'insertar' => 'AccionesController#insertAccion',
        'borrar' => 'AccionesController#deleteAccion',
    ];
}
?>