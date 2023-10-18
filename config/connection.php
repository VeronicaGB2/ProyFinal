<?php
class DB {
    private $servername = "localhost";
    private $DBUser = 'vero';
    private $DBPass = 'gdANEgRApaUD';
    private $dbname = "proyecto_final";
    private $conn;

    // Constructor - Establecer la conexión
    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->DBUser, $this->DBPass, $this->dbname);

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
