<?php
require_once "./views/ComentariosView.php";
require_once "./models/AccionModel.php";
require_once "./models/RegionModel.php";
require_once "./models/UsuarioModel.php";

class ComentariosController {
    protected $view;
    protected $accionesModel;
    protected $regionesModel;
    protected $usuarioModel;

    function __construct() {
        $this->view = new ComentariosView();
        $this->accionesModel = new AccionModel();
        $this->regionesModel = new RegionModel();
        $this->usuarioModel = new UsuarioModel();
    }

    function verComentarios() {
        session_start();
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $logueado = true;
            $isAdmin = $this->usuarioModel->isAdmin($user);
        }
        else {
            $user = 'Guest';
            $logueado = false;
            $isAdmin = false;
        }
        $title = 'Comentarios';
        $acciones = $this->accionesModel->fetchAll();
        $regiones = $this->regionesModel->fetchRegiones();
        $this->view->verComentarios($title, $acciones, $regiones, $user, $logueado, $isAdmin);
    }
}