<?php

//require_once '../models/conexion.php';
//require_once '../assets/adodb5/adodb.inc.php';

session_start();

// Recuperar datos del formulario
$correo = $_POST['txtCorreo']; // Nombre del campo de usuario
$pwd = $_POST['txtPwd']; // Nombre del campo de contraseña

// Verificar si los campos no están vacíos
if (!empty($correo) && !empty($pwd)) {

    // Incluir la clase de conexión
    require_once ('../models/conexion.php');

     // Crear una instancia de la clase Conexion
     $conexion = new Conexion();
     $conn = $conexion->conectar(); // Obtener la conexión con ADODB
 

    // Preparar la consulta utilizando sentencias preparadas para evitar inyección SQL
    $consulta = "SELECT * FROM usuarios WHERE correo=? AND contrasena=?";
    $stmt = $conn->Prepare($consulta);

    // Vincular parámetros y ejecutar consulta
    $params = array($correo, $pwd);
    $result = $conn->Execute($stmt, $params);

    // Obtener resultados
    $filas = $result->RecordCount();

    if ($filas > 0) {

        $fila = $result->FetchRow();
        
        switch ($fila['rol']) {
            case 1: // Administrador
                header("Location: ../admin/administrador.php");
                break;
            case 2: // Usuario autenticado
                header("Location: ../usuario/usuarioAutenticado.php");
                break;
            case 3: // Invitado
                header("Location: ../invitado/invitado.php");
                break;
            default: // Usuario o contraseña incorrectos
                include("login.php");
                echo '<script>alert("Error de autenticación!");</script>';
                break;
        }
    } else {
        // Usuario o contraseña incorrectos, mostrar mensaje de error
        include("login.php");
        echo '<script>alert("Error de autenticación!");</script>';
    }

    // Cerrar conexión
    $conn->Close();
} else {
    // Si los campos están vacíos, volver al formulario de inicio de sesión
    header("location: login.php");
    exit();
}
?>
