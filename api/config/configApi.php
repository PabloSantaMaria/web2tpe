<?php

class ConfigApi {
    public static $RESOURCE = 'resource';
    public static $PARAMS = 'params';
    public static $RESOURCES = [
        'comentarios#GET' => 'ComentariosApiController#comentariosAccion',
        'comentario#DELETE' => 'ComentariosApiController#deleteComentario',
        'comentario#POST' => 'ComentariosApiController#postComentario',
    ];
}