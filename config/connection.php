<?php
class DB {
    private $servername = "localhost";
    private $DBUser = 'vero';
    private $DBPass = '1234'; //1234
    private $dbname = "proyecto_final";
    private $conn;
    //YoA+!o7nz6k7

    // Constructor - Establecer la conexión
    public function __construct() {
        try {
            $dsn = "mysql:host=$this->servername;dbname=$this->dbname";
            $this->conn = new PDO($dsn, $this->DBUser, $this->DBPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    // Obtener la conexión
    public function getConnection() {
        return $this->conn;
    }
}
?>
