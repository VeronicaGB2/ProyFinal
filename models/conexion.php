<?php
class Conexion{
    private $DBServer = 'localhost'; // server name or IP address
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'proyecto_final';
    private $con;

    public function __construct() {
    }

    public function conectar(){
        try {
            $dsn = "mysql:host={$this->DBServer};dbname={$this->DBName}";
            $this->con = new PDO($dsn, $this->DBUser, $this->DBPass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->con;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}
?>