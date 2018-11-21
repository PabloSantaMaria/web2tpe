<?php

class ConfigApi {
    public static $RESOURCE = 'resource';
    public static $PARAMS = 'params';
    public static $RESOURCES = [
        'accion#GET' => 'AccionesApiController#detalleAccion',
        'accion#DELETE' => 'AccionesApiController#deleteAccion',
        'accion#PUT' => 'AccionesApiController#updateAccion',
        'create#POST' => 'AccionesApiController#insertAccion'
    ];
}