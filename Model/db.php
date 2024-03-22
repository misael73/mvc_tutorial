<?php
require_once 'config/config.php';
class db {
    private $host;
    private $db;
    private $user;
    private $pass;
    public $connection;
    private $libros;

    public function __construct() {
        $this->Conexion();
    }

    public function Conexion() {
        $this->host = DB_HOST;
        $this->db = DB;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }


}
?>
