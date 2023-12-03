<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['txtCorreo'];
    $pwd = $_POST['txtPwd'];

    if (!empty($correo) && !empty($pwd)) {
        require_once('../models/conexion.php');

        $conexion = new Conexion();
        $conn = $conexion->conectar();
        
        $consulta = "SELECT * FROM usuarios WHERE correo=?";
        $stmt = $conn->prepare($consulta);
        $stmt->execute([$correo]);

        
        

        $fila = $stmt->fetch();
  

        if ($fila && ($pwd == $fila['contrasena'])) {
            switch ($fila['rol']) {
                case 1:
                    $response = array('redirect' => '../admin/administrador.php');
                    break;
                case 2:
                    $response = array('redirect' => '../usuario/usuarioAutenticado.php');
                    break;
                case 3:
                    $response = array('redirect' => '../invitado/invitado.php');
                    break;
                default:
                    $response = array('error' => 'Error de autenticación!');
                    break;
            }
        } else {
            $response = array('error' => 'Error de autenticación!');
        }

        $conn = null;

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = array('redirect' => 'login.php');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
?>