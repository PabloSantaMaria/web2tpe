<?php

class LoginModel {
  private $db;

  function __construct() {
    $this->db = $this->connect();
  }
  private function connect() {
    return new PDO('mysql:host=localhost;'.'dbname=tabrokers;charset=utf8', 'root', '');
  }

  function fetchUser($user) {
    $sentencia = $this->db->prepare("SELECT * FROM usuarios WHERE email=?");
    $sentencia->execute(array($user));
    $dbUser = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $dbUser;
  }
}
?>