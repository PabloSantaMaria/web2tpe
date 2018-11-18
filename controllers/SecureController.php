<?php

class SecureController {
    
    /**
    * inicia sesión segura
    * expira de acuerdo al tiempo seteado en la constante de ConfigApp.php
    * redirecciona a login si el usuario no está logueado
    */
    function __construct() {
        session_start();
        if (isset($_SESSION['user'])) {
            if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > TIEMPO_DE_SESION)) {
                $this->logout();
            }
            $_SESSION['LAST_ACTIVITY'] = time();
        }
        else {
            header(LOGIN);
        }
    }
    /**
    * destruye la sesión
    */
    function logout(){
        session_start();
        session_destroy();
        header(LOGIN);
    }
}
?>