<?php
require_once "./views/AdminView.php";
require_once "./models/AccionModel.php";
require_once "./models/PaisModel.php";
require_once "./models/RegionModel.php";
require_once "./models/UsuarioModel.php";
require_once "./controllers/SecureController.php";

class AdminController extends SecureController {
    private $view;
    private $accionModel;
    private $paisModel;
    private $regionModel;
    private $usuarioModel;
    private $regiones;
    private $paises;
    private $acciones;
    private $metodos;
    private $mensaje;
    
    function __construct() {
        parent::__construct();
        $this->view = new AdminView();
        $this->accionModel = new AccionModel();
        $this->paisModel = new PaisModel();
        $this->regionModel = new RegionModel();
        $this->usuarioModel = new UsuarioModel();
        $this->regiones = $this->regionModel->fetchRegiones();
        $this->paises = $this->paisModel->fetchPaises();
        $this->mensaje = 'Administrar datos';
        $this->metodos = array(
            'verRegion' => array('region'),
            'verPais' => array('pais'),
            'verTodas' => array(),
            'guardarRegion' => array('nuevaRegion'),
            'guardarPais' => array('nuevoPais'),
            'guardarAccion' => array('accionAccion', 'paisAccion', 'precioAccion', 'variacionAccion', 'volumenAccion', 'maximoAccion', 'minimoAccion'),
            'guardarUsuario' => array('nuevoUser'),
            'borrarUsuario' => array('userBorrar'),
            'editarUsuario' => array()
        );
    }
    /**
    * home de admin
    */
    function adminHome() {
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $isAdmin = $this->usuarioModel->isAdmin($user);
            if ($isAdmin) {
                $this->actualizarDropdowns();
                $usuarios = $this->usuarioModel->getUsuarios();
                $this->view->adminHome($this->regiones, $this->paises, $this->mensaje, $usuarios);
            }
            else {
                header(LOGIN);
            }
        }
        else {
            header(LOGIN);
        }
    }
    /**
    * opciones de control de admin
    * llegan por url
    */
    function adminControl($action) {
        $nombreMetodo = $action[0];
        $argumentos = array();
        if (array_key_exists($nombreMetodo, $this->metodos)) {
            foreach ($this->metodos[$nombreMetodo] as $arg) {
                array_push($argumentos, $_POST[$arg]);
            }
            call_user_func_array(array($this, $nombreMetodo), $argumentos);
        }
        $this->actualizarDropdowns();
        $usuarios = $this->usuarioModel->getUsuarios();
        $this->view->adminDisplay($this->regiones, $this->paises, $this->acciones, $this->mensaje, $usuarios);
    }
    /**
    * muestra todas las acciones de una región
    */
    private function verRegion($region){
        $this->acciones = $this->regionModel->fetchRegion($region);
        $this->mensaje = 'Mostrando registros de ' . $region;
    }
    /**
    * muestra todas las acciones de un país
    */
    private function verPais($pais){
        $this->acciones = $this->paisModel->fetchPais($pais);
        $this->mensaje = 'Mostrando registros de ' . $pais;
    }
    /**
    * muestra todas las acciones
    */
    private function verTodas(){
        $this->acciones = $this->accionModel->fetchAll();
        $this->mensaje = 'Mostrando todos los registros';
    }
    /**
    * guarda una región nueva
    * verifica si ya existe
    */
    private function guardarRegion($region){
        if ($this->existeItem("region", $region)) {
            $this->mensaje = 'La región ' . $region . ' ya existe en la base de datos. Mostrando registros de la región';
        }
        else {
            $this->regionModel->insertRegion($region);
            $this->mensaje = 'Región ' . $region . ' agregada con éxito';
        }
        $this->acciones = $this->regionModel->fetchRegion($region);
    }
    /**
    * guarda un país nuevo en la región elegida
    * no se puede elegir una región inexistente
    * verifica si ya existe
    */
    private function guardarPais($pais){
        if ($this->existeItem("pais", $pais)) {
            $this->mensaje = "El país " . $pais . " ya existe en la base de datos";
        }
        else {
            $region = $_POST['perteneceRegion'];
            $id_region = $this->getID("region", $region);
            $this->paisModel->insertPais($pais, $id_region);
            $this->mensaje = "País " . $pais . " agregado con éxito";
        }
        $this->acciones = $this->paisModel->fetchPais($pais);
    }
    /**
    * guarda una nueva acción en el país elegido
    * no se puede elegir un país inexistente
    * el país ya pertenece a una región
    * verifica que no exista el nombre de la acción
    */
    private function guardarAccion($accion){
        if ($this->existeItem("accion", $accion)) {
            $this->mensaje = "El registro " . $accion . " ya existe en la base de datos";
        }
        else {
            $pais = $_POST["paisAccion"];
            $id_pais = $this->getID("pais", $pais);
            $precio = $_POST["precioAccion"];
            $variacion = $_POST["variacionAccion"];
            $volumen = $_POST["volumenAccion"];
            $maximo = $_POST["maximoAccion"];
            $minimo = $_POST["minimoAccion"];
            $this->accionModel->insertAccion($accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo);
            $id_accion = $this->getID("accion", $accion);
            $this->mensaje = "Acción " . $accion . " agregada con éxito";
        }
        $this->acciones = $this->accionModel->fetchAccion($id_accion);
    }
    /**
    * guarda un nuevo usuario administrador
    * encripta la contraseña
    * verifica que no exista el mismo nombre
    */
    private function guardarUsuario($user){
        if ($this->existeItem("usuario", $user)) {
            $this->mensaje = "El usuario " . $user . " ya existe en la base de datos";
        }
        else {
            $pass = $_POST["nuevaPass"];
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            if (isset($_POST['comoAdmin'])) {
                $isAdmin = 1;
            } else {
                $isAdmin = null;
            }
            $this->usuarioModel->insertUsuario($user, $hash, $isAdmin);
            $this->mensaje = "El usuario " . $user . " ha sido agregado con éxito";
        }
    }
    /**
    * borra un usuario si existe y si se sabe la contraseña
    */
    private function borrarUsuario($user){
        if ($this->existeItem("usuario", $user)) {
            $pass = $_POST['passBorrar'];
            $dbUser = $this->usuarioModel->fetchUser($user);
            if (password_verify($pass, $dbUser['pass'])) {
                $this->usuarioModel->deleteUser($user);
                $this->mensaje = "El usuario " . $user . " ha sido borrado";
            }
        }
        else {
            $this->mensaje = "El usuario " . $user . " no existe en la base de datos";
        }
    }
    
    function editarUsuario() {
        $user = $_POST['usuarioEdit'];
        
        if (isset($_POST['hacerAdmin'])) {
            $this->usuarioModel->editarPermisos($user, 1);
            $this->mensaje = "El usuario con ID " . $user . " es administrador";
        }
        elseif (isset($_POST['quitarAdmin'])) {
            $this->usuarioModel->editarPermisos($user, 0);
            $this->mensaje = "El usuario con ID " . $user . " no es más administrador";
        }
        elseif (isset($_POST['borrarUsuario'])) {
            $this->usuarioModel->deleteUserById($user);
            $this->mensaje = "El usuario con ID " . $user . " ha sido borrado";
        }
        
    }
    /**
    * muestra los datos de una acción para editarla
    */
    function editAccion($params) {
        $id_accion = $params[0];
        $accion = $this->accionModel->fetchAccion($id_accion);
        $paises = $this->paisModel->fetchPaises();
        $this->view->displayUpdateForm($accion, $paises, $this->regiones);
    }
    
    function sonJPG($ruta){
        $valor=false;
        $tamaño = strlen($ruta)-3;
        $ext = substr($ruta, $tamaño);
        if(($ext == "jpg") || ($ext == "png")){
            $valor=true;
        }
        return $valor;
    }
    
    /**
    * actualiza una acción
    * vuelve al form para seguir editándola si es necesario
    */
    function updateAccion(){
        $id_accion = $_POST["id_accion"];
        
        if (isset($_POST['borrarImagen'])) {
            $this->accionModel->borrarImagen($id_accion);
        }
        elseif (isset($_POST['editarRegistro'])) {
            $accion = $_POST["editNombre"];
            $pais = $_POST["editPais"];
            $id_pais = $this->getID("pais", $pais);
            $precio = $_POST["editPrecio"];
            $variacion = $_POST["editVariacion"];
            $volumen = $_POST["editVolumen"];
            $maximo = $_POST["editMaximo"];
            $minimo = $_POST["editMinimo"];
            $ruta = $_FILES["imagen"]["name"];
            $variable = $this->sonJPG($ruta);
            
            if (($variable) || $ruta == null) {
                $rutaTempImagenes = $_FILES['imagen']['tmp_name'];
                $this->accionModel->updateAccion($id_accion, $accion, $id_pais, $precio, $variacion, $volumen, $maximo, $minimo, $rutaTempImagenes);
            }
        }
        $accion = $this->accionModel->fetchAccion($id_accion);
        $paises = $this->paisModel->fetchPaises();
        $this->view->displayUpdateForm($accion, $paises, $this->regiones);
    }
    
    /**
    * borra una acción
    * muestra las acciones de la región a la que pertenecía
    */
    function deleteAccion($params) {
        $id_accion = $params[0];
        $pais = $this->accionModel->fetchAccion($id_accion)[0]['pais'];
        $region = $this->paisModel->fetchRegionDePais($pais)[0]['region'];
        $this->accionModel->deleteAccion($id_accion);
        $this->mensaje = "Registro borrado con éxito";
        $this->actualizarDropdowns();
        $acciones = $this->regionModel->fetchRegion($region);
        $this->view->adminDisplay($this->regiones, $this->paises, $acciones, $this->mensaje);
    }
    /**
    * borra una región
    * primero borra todas las acciones que pertenecen a los países de la región
    * luego borra todos los países que pertenecen a la región
    */
    function deleteRegion() {
        $region = $_POST['borrarRegion'];
        $acciones = $this->regionModel->fetchRegion($region);
        $paises = $this->paisModel->fetchPaisesPorRegion($region);
        $id_region = $this->getID('region', $region);
        foreach ($acciones as $accion) {
            $this->accionModel->deleteAccion($accion['id_accion']);
        }foreach ($paises as $pais) {
            $this->paisModel->deletePais($pais['id_pais']);
        }
        $this->regionModel->deleteRegion($id_region);
        $this->mensaje = 'Se borró la región y todos los registros asociados';
        $this->adminHome();
    }
    /**
    * función auxiliar que devuelve si un dato existe en una tabla
    */
    private function existeItem($tabla, $item) {
        $model = $tabla . "Model";
        return $this->$model->existeItem($tabla, $item);
    }
    /**
    * función auxiliar que devuelve el id de un registro
    */
    private function getID($tabla, $item) {
        $model = $tabla . "Model";
        return $this->$model->getID($tabla, $item);
    }
    /**
    * actualiza las regiones y los países existentes en la db para poder elegirlos en dropdowns
    */
    private function actualizarDropdowns() {
        $this->regiones = $this->regionModel->fetchRegiones();
        $this->paises = $this->paisModel->fetchPaises();
    }
}