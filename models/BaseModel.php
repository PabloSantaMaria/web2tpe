<?php

require_once './config/Database.php';

abstract class BaseModel {
    protected $db;

    function __construct() {
        $this->db = Database::connect()->database;
    }
}

?>