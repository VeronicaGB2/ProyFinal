<?php
class funcionM
{
    private $id_p;
    private $nombre;
    private $descripcion;
    private $precio;
    private $unidadesStock;
    private $puntoROrden;
    private $unidadesComprometidas;
    private $costo;
    private $img;
    private $db;


    public function __construct()
    {
        $con = new Conexion();
        $this->db = $con->conectar();
    }

    //seran funciones que utilzaremos
    public function insertMensaje()
    {
        $target_file = ""; // Inicializar la variable target_file
        // Verificar si 'fileImg' está definido en $_FILES
        $record = array();
        if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] === UPLOAD_ERR_OK) {
            $fileImg = $_FILES['fileImg']['name'];
            $target_dir = __DIR__ . '/../assets/imagenes/';
            $target_file = $target_dir . basename($fileImg);

            // Crear el directorio si no existe
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Verificar si el archivo es válido
            if (is_uploaded_file($_FILES['fileImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $target_file)) {
                    echo "El archivo " . htmlspecialchars(basename($_FILES['fileImg']['name'])) . " ha sido subido.";
                    $record['url_imagen'] =  "/imagenes/".$_FILES['fileImg']['name'];
                } else {
                    echo "Lo sentimos, hubo un error subiendo tu archivo.";
                }
            } else {
                echo "Error: Archivo no válido.";
            }
        } else {
            echo "Error al subir el archivo.";
        }



        $table = 'productos';

        $record['nombre'] = $_POST['txtNombre'];
        $record['descripcion'] = $_POST['txtDesc'];
        $record['precio'] = $_POST['txtPrecio'];
        $record['unidades_en_stock'] = $_POST['txtUniS'];
        $record['punto_de_reorden'] = $_POST['txtPuntoOrd'];
        $record['unidades_comprometidas'] = $_POST['txtUniComp'];
        $record['costo'] = $_POST['txtCosto'];

        // Verificar si $target_file no está vacío antes de asignarlo a la columna 'url_imagen'



        $stmt = $this->db->prepare("INSERT INTO $table (nombre, descripcion, precio, unidades_en_stock, punto_de_reorden, unidades_comprometidas, costo, url_imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param('ssssssss', $record['nombre'], $record['descripcion'], $record['precio'], $record['unidades_en_stock'], $record['punto_de_reorden'], $record['unidades_comprometidas'], $record['costo'], $record['url_imagen']);

        $stmt->execute();
        $stmt->close();
        //$this->db->autoExecute($table,$record,'INSERT');

    }
    public function updateMensaje()
    {
        $target_file = "";
        $record = array();
        if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] === UPLOAD_ERR_OK) {
            $fileImg = $_FILES['fileImg']['name'];
            $target_dir = __DIR__ . '/../assets/imagenes/';
            $target_file = $target_dir . basename($fileImg);

            // Crear el directorio si no existe
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Verificar si el archivo es válido
            if (is_uploaded_file($_FILES['fileImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $target_file)) {
                    echo "El archivo " . htmlspecialchars(basename($_FILES['fileImg']['name'])) . " ha sido subido.";
                    $record['url_imagen'] =  "/imagenes/".$_FILES['fileImg']['name'];
                } else {
                    echo "Lo sentimos, hubo un error subiendo tu archivo.";
                }
            } else {
                echo "Error: Archivo no válido.";
            }
        } else {
            $record['url_imagen'] = $_POST['url_imagen'];
        }

        $table = 'productos';
        $record['nombre'] = $_POST['txtNombre'];
        $record['descripcion'] = $_POST['txtDesc'];
        $record['precio'] = $_POST['txtPrecio'];
        $record['unidades_en_stock'] = $_POST['txtUniS'];
        $record['punto_de_reorden'] = $_POST['txtPuntoOrd'];
        $record['unidades_comprometidas'] = $_POST['txtUniComp'];
        $record['costo'] = $_POST['txtCosto'];
        $id=$_POST['hddId'];        

  
        $stmt = $this->db->prepare("UPDATE $table SET nombre=?, descripcion=?, precio=?, unidades_en_stock=?, punto_de_reorden=?, unidades_comprometidas=?, costo=?, url_imagen=? WHERE id=?");

        $stmt->bind_param('ssssssssi', $record['nombre'], $record['descripcion'], $record['precio'], $record['unidades_en_stock'], $record['punto_de_reorden'], $record['unidades_comprometidas'], $record['costo'], $record['url_imagen'], $id);

        $stmt->execute();
        $stmt->close();

       
    }

    

    public function deleteMensaje($id)
    {
        $id = intval($id);

        if ($id > 0) {
            $query = "DELETE FROM productos WHERE id = $id";
            $res = $this->db->query($query);
            if ($res) {
                echo "Registro eliminado correctamente";
            } else {
                echo "Error al eliminar el registro";
            }
        } else {
            echo "ID no válido para eliminar el registro";
        }
    }


    public function getAllMensajes()
    {
        $query = "SELECT * FROM productos";

        // Execute the query
        $result = $this->db->query($query);

        if ($result) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } else {
            echo "Error in query: " . $this->db->error;
            return false;
        }
    }
    
}
