<?php
require_once "./views/NavView.php";
require_once "./models/AccionModel.php";
require_once "./models/RegionModel.php";

class NavController {
    protected $view;
    protected $accionModel;
    protected $regionModel;
    protected $regiones;
    
    /**
    * inicializa las regiones que puede ver el visitante
    */
    function __construct() {
        $this->view = new NavView();
        $this->accionModel = new AccionModel();
        $this->regionModel = new RegionModel();
        $this->regiones = $this->regionModel->fetchRegiones();
    }
    /**
    * muestra página principal
    */
    function home() {
        $title = 'Home';
        $this->view->home($title, $this->regiones);
    }
    /**
    * trae y muestra las cotizaciones de la región que eligió el visitante
    */
    function displayCotizaciones($params) {
        if ($params[0] == '') {
            $region = 'todas las regiones';
            $title = 'Todas las cotizaciones';
            $acciones = $this->accionModel->fetchAll();
        }
        else {
            $region = $params[0];
            $title = 'Cotizaciones de ' . $region;
            $acciones = $this->regionModel->fetchRegion($region);
        }
        $this->view->displayCotizaciones($title, $acciones, $this->regiones, $region);
    }
    
    function detalleAccion($params) {
        $accion = $this->accionModel->fetchAccion($params[0]);
        $title = 'Detalle de acción';
        $this->view->detalleAccion($title, $this->regiones, $accion);
    }
    /**
    * muestra página acerca de nosotros
    */
    function acerca() {
        $title = 'Acerca de nosotros';
        $this->view->acerca($title, $this->regiones);
    }
}