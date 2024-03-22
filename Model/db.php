<?php
require_once 'config/config.php';
require_once "model/Libros.php";

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

    public function Registraralumno($isbn, $nombre, $autor, $an, $editorial, $pag){
        $sql = "INSERT INTO libros (isbn, nombre_libro, autor, an, editorial, pag) VALUES ('$isbn','$nombre','$autor','$an','$editorial','$pag')";
        $resultado = mysqli_query($this->connection, $sql);
        if($resultado){
            return true;
        } else {
            return false;
        }
    }

    public function Consultaralumno(){
        $sql = "SELECT * FROM libros";
        $resultado = mysqli_query($this->connection, $sql);
        $libros = array();
        if($resultado){
            while($row = $resultado->fetch_assoc()) {
                $libro = new Libros($row["isbn"], $row["nombre_libro"], $row["autor"], $row["an"], $row["editorial"], $row["pag"]);
                array_push($libros, $libro);
            }
        }
        return $libros;
    }

    public function obtenerLibroPorISBN($isbn){
    $stmt = $this->connection->prepare("SELECT * FROM libros WHERE isbn = ?");
    $stmt->bind_param("s", $isbn);
    $stmt->execute();
    $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $libro = $resultado->fetch_object();
            return $libro;
        } else {
            return null;
        }
    }

    // Clase db (model/db.php)
    public function eliminarLibro($isbn)
    {
        $stmt = $this->connection->prepare("DELETE FROM libros WHERE isbn = ?");
        $stmt->bind_param("s", $isbn);
        $resultado = $stmt->execute();
        return $resultado;
    }


}
?>
