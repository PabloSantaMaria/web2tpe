<?php
require_once "./controllers/NavController.php";
require_once "./models/UsuarioModel.php";

class LoginController extends NavController {
    
    private $usuarioModel;
    // private $user;
    
    function __construct() {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
    }
    /**
    * muestra página de login
    */
    function login() {
        $title = 'Login';
        $mensaje = 'Ingrese credenciales';
        $this->view->displayLogin($title, $this->regiones, $mensaje);
    }
    /**
    * muestra página de registro
    */
    function signIn() {
        $title = 'Registro';
        $mensaje = 'Registe su nombre de usuario y contraseña';
        $this->view->displaySignin($title, $this->regiones, $mensaje);
    }
    
    function verifyRegister() {
        $user = $_POST['user'];
        $dbUser = $this->usuarioModel->fetchUser($user);
        
        if ($dbUser) {
            $title = 'Registro';
            $mensaje = 'El usuario ya existe';
            $this->view->displaySignin($title, $this->regiones, $mensaje);
        }
        else {// crear/guardar usuario
            $pass = $_POST["password"];
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $this->usuarioModel->insertUsuario($user, $hash, null);
            session_start();
            $_SESSION['user'] = $user;

            header(HOME);
        }
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
                header(HOME);
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