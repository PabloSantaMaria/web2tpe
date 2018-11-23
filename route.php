<?php
require_once "config/ConfigApp.php";
require_once "controllers/NavController.php";
require_once "controllers/LoginController.php";
require_once "controllers/ComentariosController.php";
require_once "controllers/AdminController.php";
require_once "controllers/SecureController.php";

function parseURL($url) {
    $explodedURL = explode('/', $url);
    $array[ConfigApp::$ACTION] = $explodedURL[0];
    $array[ConfigApp::$PARAMS] = isset($explodedURL[1]) ? array_slice($explodedURL, 1) : null;
    return $array;
}

if (isset($_GET['action'])) {
    $url = parseURL($_GET['action']);
    $action = $url[ConfigApp::$ACTION];
    if (array_key_exists($action, ConfigApp::$ACTIONS)) {
        $params = $url[ConfigApp::$PARAMS];
        $action = explode('#', ConfigApp::$ACTIONS[$action]);
        $controller = new $action[0]();
        $metodo = $action[1];
        if (isset($params) && $params != null) {
            echo $controller->$metodo($params);
        } else {
            echo $controller->$metodo();
        }
    } else {
        $controller = new NavController();
        echo $controller->home();
    }
}
?>