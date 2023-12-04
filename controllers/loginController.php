<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'login') {
        $correo = $_POST['txtCorreo'];
        $pwd = $_POST['txtPwd'];

        if (!empty($correo) && !empty($pwd)) {
            require_once('../config/connection.php');

            $conexion = new DB();
            $conn = $conexion->getConnection();

            $consulta = "SELECT * FROM usuarios WHERE correo=?";
            $stmt = $conn->prepare($consulta);
            $stmt->execute([$correo]);

            $fila = $stmt->fetch();

            if ($fila && ($pwd == $fila['contrasena'])) {
                switch ($fila['rol']) {
                    case 1:
                        $_SESSION['user'] = $fila; 
                        $response = array('redirect' => '../vistas/admin/index.php');
                       
                        break;
                    case 2:
                        $_SESSION['user'] = $fila; 
                        $response = array('redirect' => '../vistas/index.php');
                        break;
                    case 3:
                        $_SESSION['user'] = $fila; 
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
    } elseif ($action == 'register') {

        $correo = $_POST['txtCorreo'];
        $pwd = $_POST['txtPwd'];
        $nombre = $_POST['txtNombre'];
        $direccion = $_POST['txtDireccion'];

        if (!empty($correo) && !empty($pwd)) {
            require_once('../config/connection.php');

            $conexion = new DB();
            $conn = $conexion->getConnection();

            $consulta = "INSERT INTO usuarios ( correo, contrasena, nombre, direccion) VALUES (?, ?, ?, ? )";
            $stmt = $conn->prepare($consulta);
           
            $stmt->execute([ $correo, $pwd, $nombre, $direccion]);
            header('Content-Type: application/json');
            $response = array('redirect' => 'login.php');

            echo json_encode($response);

            $conn = null;
        } else {
            header('Content-Type: application/json');
            $response = array('error' => 'Error de registro!');

            echo json_encode($response);
            exit();
        }
    }
}
