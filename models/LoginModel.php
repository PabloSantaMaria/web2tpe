<?php

class LoginModel {
  private $db;

  /**
   * inicializa db y crea objeto PDO
   */
  function __construct() {
    $this->db = $this->connect();
  }

  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }
  /**
   * trae los datos de un usuario existente
   */
  function fetchUser($user) {
    $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE usuario=?");
    $sentencia->execute(array($user));
    $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $dbUser;
  }
}
?>