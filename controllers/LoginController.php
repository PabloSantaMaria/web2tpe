<?php
require_once "./views/LoginView.php";
require_once "./models/LoginModel.php";

class LoginController {
  private $view;
  private $model;

  function __construct() {
    $this->view = new LoginView();
    $this->model = new LoginModel();
  }

  function login() {
    $this->view->displayLogin();
  }
  
  function logout() {
    session_start();
    session_destroy();
    header(HOME);
  }
  

  function verify() {
      $user = $_POST['user'];
      $pass = $_POST['password'];
      $dbUser = $this->model->fetchUser($user);
      
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
}
?>