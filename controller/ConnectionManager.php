<?php

class ConnectionManager extends mysqli{

    protected static $conn;
    protected $host = "localhost";
    protected $dbName = "itv";
    protected $user = "dwes";
    protected $pass = "abc123.";
    protected $charset = "utf8mb4";
    
    
    public function __construct() {
        parent::__construct($this->host, $this->user, $this->pass, $this->dbName); 
        $this->set_charset($this->charset); 
    }
    
    public static function getConnectionInstance() {
        if (self::$conn == null) {
            self::$conn = new ConnectionManager();
        }
        return self::$conn;
    }
}

?>
