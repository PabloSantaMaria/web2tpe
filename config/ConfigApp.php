<?php
class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'NavController#home',
        'home' => 'NavController#home',
        'agregar' => 'AccionesController#insert',
        'borrar' => 'AccionesController#delete',
        'completada' => 'AccionesController#update'
    ];
}
?>