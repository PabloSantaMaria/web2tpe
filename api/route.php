<?php
require_once "config/ConfigApi.php";

function parseURL($url) {
    $explodedURL = explode('/', $url);
    $array[ConfigApi::$RESOURCE] = $explodedURL[0].'#'.$_SERVER['REQUEST_METHOD'];
    $array[ConfigApi::$PARAMS] = isset($explodedURL[1]) ? array_slice($explodedURL, 1) : null;
    return $array;
}

if (isset($_GET['resource'])) {
    $url = parseURL($_GET['resource']);
    $resource = $url[ConfigApi::$RESOURCE];
    if (array_key_exists($resource, ConfigApi::$RESOURCES)) {
        $params = $url[ConfigApi::$PARAMS];
        $resource = explode('#', ConfigApi::$RESOURCES[$resource]);
        $controller = new $resource[0]();
        $metodo = $resource[1];
        if (isset($params) && $params != null) {
            echo $controller->$metodo($params);
        } else {
            echo $controller->$metodo();
        }
    }
}