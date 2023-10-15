<?php
class DB {
    private $servername = "localhost";
    private $username = "vero";
    private $password = "gdANEgRApaUD";
    private $dbname = "proyecto_final";
    private $conn;

    // Constructor - Establecer la conexión
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Obtener la conexión
    public function getConnection() {
        return $this->conn;
    }
}
?>
