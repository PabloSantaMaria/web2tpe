<?php
require_once 'ConfigApp.php';

class Database {
    public $database;
    private $dbms, $host, $dbname, $username, $password, $dsn;
    private static $dbInstance;

    private function __construct() {
        $this->dbms = ConfigApp::$DB['dbms'];
        $this->host = ConfigApp::$DB['host'];
        $this->dbname = ConfigApp::$DB['dbname'];
        $this->username = ConfigApp::$DB['username'];
        $this->password = ConfigApp::$DB['password'];
        $this->dsn = $this->dbms . ':host=' . $this->host . ';dbname=' . $this->dbname . ';charset=utf8';

        $this->database = new PDO($this->dsn, $this->username, $this->password);
    }

    public static function connect() {
        if (!isset(self::$dbInstance)) {
            self::$dbInstance = new self();
        }
        return self::$dbInstance;
    }
}

?>