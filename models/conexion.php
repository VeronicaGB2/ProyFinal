<?php
class Conexion{
    private $DBServer = 'localhost'; // server name or IP address
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'proyecto_final';
    private $con;

    public function __construct() {
    }

    public function conectar() {
        $con = new mysqli($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);

        // Verifica la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        return $con;
    }
}
?>