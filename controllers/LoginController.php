<?php
require_once "./controllers/NavController.php";
require_once "./models/UsuarioModel.php";

class LoginController extends NavController {
    
    private $usuarioModel;
    
    function __construct() {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
    }
    /**
    * muestra página de login
    */
    function login() {
        $title = 'Login';
        $mensaje = 'Ingrese credenciales de administrador';
        $this->view->displayLogin($title, $this->regiones, $mensaje);
    }
    /**
    * valida el usuario
    * verifica que exista
    */
    function verify() {
        $user = $_POST['user'];
        $pass = $_POST['password'];
        $dbUser = $this->usuarioModel->fetchUser($user);
        
        if ($dbUser) {
            if (password_verify($pass, $dbUser['pass'])) {
                session_start();
                $_SESSION['user'] = $user;
                header(ADMIN);
            }
            else {
                $title = 'Login';
                $mensaje = 'Contraseña incorrecta';
                $this->view->displayLogin($title, $this->regiones, $mensaje);
            }
        }
        else {
            $title = 'Login';
            $mensaje = 'El usuario no existe';
            $this->view->displayLogin($title, $this->regiones, $mensaje);
        }
    }
    /**
    * destruye la sesión
    * redirecciona a home
    */
    function logout() {
        session_start();
        session_destroy();
        header(HOME);
    }
}