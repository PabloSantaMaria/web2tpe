<?php

class ConfigApi {
    public static $RESOURCE = 'resource';
    public static $PARAMS = 'params';
    public static $RESOURCES = [
        'comentarios#GET' => 'ComentariosApiController#comentariosAccion',
        'comentario#DELETE' => 'ComentariosApiController#deleteComentario',
        'accion#PUT' => 'AccionesApiController#updateAccion',
        'create#POST' => 'AccionesApiController#insertAccion'
    ];
}