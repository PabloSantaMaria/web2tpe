<?php
require_once "./controllers/NavController.php";
require_once "./models/LoginModel.php";

class LoginController extends NavController {
  
  private $loginModel;

  function __construct() {
    parent::__construct();
    $this->loginModel = new LoginModel();
  }

  function login() {
    $title = 'Login';
    $this->view->displayLogin($title, $this->regiones);
  }
  function verify() {
    $user = $_POST['user'];
    $pass = $_POST['password'];
    $dbUser = $this->loginModel->fetchUser($user);
    
    if (isset($dbUser)) {
      if (password_verify($pass, $dbUser['pass'])) {
        session_start();
        $_SESSION['user'] = $user;
        header(ADMIN);
      }
      else {
        //pedir login otra vez
      }
    }
    else {
      //esto no anda?
        echo "no esiste";
    }
  }
  function logout() {
    session_start();
    session_destroy();
    header(HOME);
  }
}
?>