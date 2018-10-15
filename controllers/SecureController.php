<?php

class SecureController {

  function __construct() {
    session_start();
    if (isset($_SESSION['user'])) {
        # code...
    }
  }
}


?>