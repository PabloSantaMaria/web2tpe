<?php
require_once "./views/ComentariosView.php";
require_once "./models/AccionModel.php";
require_once "./models/RegionModel.php";

class ComentariosController {
    protected $view;
    protected $accionesModel;
    protected $regionesModel;

    function __construct() {
        $this->view = new ComentariosView();
        $this->accionesModel = new AccionModel();
        $this->regionesModel = new RegionModel();
    }

    function verComentarios() {
        $title = 'Comentarios';
        $acciones = $this->accionesModel->fetchAll();
        $regiones = $this->regionesModel->fetchRegiones();
        $this->view->verComentarios($title, $acciones, $regiones);
    }
}