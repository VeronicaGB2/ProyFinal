<?php
require_once '../config/connection.php';
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
        $con = new DB();
        $this->db = $con->getConnection();
    }

    public function insertMensaje()
    {
        $record = array();
        $target_file = "";

        if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] === UPLOAD_ERR_OK) {
            $fileImg = $_FILES['fileImg']['name'];
            $target_dir = __DIR__ . '/../assets/imagenes/';
            $target_file = $target_dir . basename($fileImg);

            // Create the directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Verify if the file is valid
            if (is_uploaded_file($_FILES['fileImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES['fileImg']['name'])) . " has been uploaded.";
                    $record['url_imagen'] =  "/imagenes/" . $_FILES['fileImg']['name'];
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Error: Invalid file.";
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

        $stmt = $this->db->prepare("INSERT INTO $table (nombre, descripcion, precio, unidades_en_stock, punto_de_reorden, unidades_comprometidas, costo, url_imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([$record['nombre'], $record['descripcion'], $record['precio'], $record['unidades_en_stock'], $record['punto_de_reorden'], $record['unidades_comprometidas'], $record['costo'], $record['url_imagen']]);

        $stmt->closeCursor();
    }

    public function updateMensaje()
    {
        $record = array();
        $target_file = "";

        if (isset($_FILES['fileImg']) && $_FILES['fileImg']['error'] === UPLOAD_ERR_OK) {
            $fileImg = $_FILES['fileImg']['name'];
            $target_dir = __DIR__ . '/../assets/imagenes/';
            $target_file = $target_dir . basename($fileImg);

            // Create the directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Verify if the file is valid
            if (is_uploaded_file($_FILES['fileImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES['fileImg']['name'])) . " has been uploaded.";
                    $record['url_imagen'] =  "/imagenes/" . $_FILES['fileImg']['name'];
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Error: Invalid file.";
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
        $id = $_POST['hddId'];

        $stmt = $this->db->prepare("UPDATE $table SET nombre=?, descripcion=?, precio=?, unidades_en_stock=?, punto_de_reorden=?, unidades_comprometidas=?, costo=?, url_imagen=? WHERE id=?");

        $stmt->execute([$record['nombre'], $record['descripcion'], $record['precio'], $record['unidades_en_stock'], $record['punto_de_reorden'], $record['unidades_comprometidas'], $record['costo'], $record['url_imagen'], $id]);

        $stmt->closeCursor();
    }

    public function deleteMensaje($id)
    {
        $id = intval($id);

        if ($id > 0) {
            $stmt = $this->db->prepare("DELETE FROM productos WHERE id = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting the record";
            }
        } else {
            echo "Invalid ID to delete the record";
        }
    }

    public function getAllMensajes()
    {
        $query = "SELECT * FROM productos";

        // Execute the query
        $stmt = $this->db->query($query);

        if ($stmt) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } else {
            echo "Error in query: " . $this->db->errorInfo()[2];
            return false;
        }
    }
}
