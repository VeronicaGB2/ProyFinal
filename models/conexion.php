<?php
require_once '../assets/adodb5/adodb.inc.php';
class Conexion{
    private $DBType = 'mysqli';
    private $DBServer = 'localhost'; // server name or IP address
    private $DBUser = 'root';
    private $DBPass = '';
    private $DBName = 'proyecto_final';
    private $con;

    public function __construct() {
    }

    public function conectar(){
        //$con = adoNewConnection($this->DBType);
        //$con->debug = true;//habilitarlo para que nos de los errores 
        //$con->connect($this->DBServer,$this->DBUser,$this->DBPass,$this->DBName);
        //return $con;
        $this->con = ADONewConnection($this->DBType);
        $this->con->debug = true; // Habilitar para mostrar errores
        $this->con->connect($this->DBServer, $this->DBUser, $this->DBPass, $this->DBName);
        return $this->con;
    }
}
?>