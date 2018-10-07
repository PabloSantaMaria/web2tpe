<?php
class ConfigApp
{
    public static $ACTION = 'action';
    public static $PARAMS = 'params';
    public static $ACTIONS = [
        '' => 'AccionesController#home',
        'home' => 'AccionesController#home',
        'agregar' => 'AccionesController#insert',
        'borrar' => 'AccionesController#delete',
        'completada' => 'AccionesController#update'
    ];

}
?>