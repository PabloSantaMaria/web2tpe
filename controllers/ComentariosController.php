<?php
require_once "./views/ComentariosView.php";
require_once "./models/AccionModel.php";
require_once "./models/RegionModel.php";
require_once "./models/UsuarioModel.php";

class ComentariosController {
    protected $view;
    protected $accionModel;
    protected $regionModel;
    protected $usuarioModel;

    function __construct() {
        $this->view = new ComentariosView();
        $this->accionModel = new AccionModel();
        $this->regionModel = new RegionModel();
        $this->usuarioModel = new UsuarioModel();
    }

    function verComentarios() {
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $id_usuario = $this->usuarioModel->getId($user);
            $logueado = true;
            $isAdmin = $this->usuarioModel->isAdmin($user);
        }
        else {
            $user = 'Guest';
            $id_usuario = null;
            $logueado = false;
            $isAdmin = false;
        }
        $title = 'Comentarios';
        $acciones = $this->accionModel->fetchAll();
        $regiones = $this->regionModel->fetchRegiones();
        $this->view->verComentarios($title, $acciones, $regiones, $user, $id_usuario, $logueado, $isAdmin);
    }
}