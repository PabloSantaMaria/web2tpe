<?php
require_once 'Database.php';

abstract class BaseModel {
    protected $db;

    function __construct() {
        $this->db = Database::connect()->database;
    }
}