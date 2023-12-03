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

    public function uploadImage($id)
    {
        $id = intval($id);

        if ($id > 0) {
            $target_dir = "/imagenes/";
            $target_file = $target_dir . basename($_FILES['fileImg']['name']);

            // Verificar si el archivo es válido
            if (is_uploaded_file($_FILES['fileImg']['tmp_name'])) {
                if (move_uploaded_file($_FILES['fileImg']['tmp_name'], $target_file)) {
                    echo "El archivo " . htmlspecialchars(basename($_FILES['fileImg']['name'])) . " ha sido subido.";
                    $record['url_imagen'] =  "/imagenes/" . $_FILES['fileImg']['name'];
                } else {
                    echo "Lo sentimos, hubo un error subiendo tu archivo.";
                }
            } else {
                echo "Error: Archivo no válido.";
            }
        } else {
            $record['url_imagen'] = $_POST['url_imagen'] ?? '';
        }

        $table = 'productos';

        $record['nombre'] = $_POST['txtNombre'] ?? '';
        $record['descripcion'] = $_POST['txtDesc'] ?? '';
        $record['precio'] = $_POST['txtPrecio'] ?? '';
        $record['unidades_en_stock'] = $_POST['txtUniS'] ?? '';
        $record['punto_de_reorden'] = $_POST['txtPuntoOrd'] ?? '';
        $record['unidades_comprometidas'] = $_POST['txtUniComp'] ?? '';
        $record['costo'] = $_POST['txtCosto'] ?? '';

        $sql = "UPDATE $table SET nombre=?, descripcion=?, precio=?, unidades_en_stock=?, punto_de_reorden=?, unidades_comprometidas=?, costo=?, url_imagen=? WHERE id=?";

        // Obteniendo la conexión existente del constructor
        $stmt = $this->db->prepare($sql);

        $params = array(
            $record['nombre'],
            $record['descripcion'],
            $record['precio'],
            $record['unidades_en_stock'],
            $record['punto_de_reorden'],
            $record['unidades_comprometidas'],
            $record['costo'],
            $record['url_imagen'],
            $id
        );

        $result = $stmt->execute($params);

        if ($result === false) {
            echo "Error al actualizar datos: " . $stmt->errorInfo()[2];
        } else {
            echo "Datos actualizados correctamente";
        }
    }

    public function deleteMensaje($id)
    {
        $id = intval($id);

        if ($id > 0) {
            $query = "SELECT unidades_comprometidas FROM productos WHERE id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $unidades_comprometidas = $row['unidades_comprometidas'];

                // Verificar si las unidades comprometidas son cero
                if ($unidades_comprometidas == 0) {
                    $deleteQuery = "DELETE FROM productos WHERE id = ?";
                    $deleteStmt = $this->db->prepare($deleteQuery);
                    $deleteResult = $deleteStmt->execute([$id]);

                    if ($deleteResult) {
                        echo "Registro eliminado correctamente";
                    } else {
                        echo "Error al eliminar el registro";
                    }
                } else {
                    echo "No se puede eliminar: unidades comprometidas no son cero";
                }
            } else {
                echo "Error al obtener información del producto";
            }
        } else {
            echo "ID no válido para eliminar el registro";
        }
    }

    public function getAllMensajes()
    {
        $query = "SELECT * FROM productos";

        // Execute the query
        $stmt = $this->db->query($query);
        return $stmt;
    }
}
