<?php
    require_once '../models/functions.php';
 
    include_once '../assets/adodb5/adodb.inc.php';

     if( isset($_GET['opc']) ){
        $msjModel = new funcionM();

        switch($_GET['opc']){
            case 1: // INSERT TO DB
                if(!empty($_POST['hddId']))
                    $msjModel->updateMensaje();
                else{
                    $msjModel->insertMensaje();
                }
                echo getMensajes($msjModel);
                break;
            case 2: // UPDATE TO BD
                $msjModel->updateMensaje();
                break;
            case 3: // DELETE TO DB
                $idMsj = $_POST['idMsj'];
                $msjModel->deleteMensaje($idMsj);
                break;
            case 4: // SELECT TO DB
                echo getMensajes($msjModel);
                break;
        }
    }else{
        header('Location: ../index.html');
    }

    function getMensajes($msjModel){
        $response = '';
        $mensajes = $msjModel->getAllMensajes();
        foreach ($mensajes as $mensaje) {
            $response .= '<tr>
                <th scope="row">1</th>
                <td>'.$mensaje['nombre'].'</td>
                <td>'.$mensaje['descripcion'].'</td>
                <td>'.$mensaje['precio'].'</td>
                <td>'.$mensaje['unidades_en_stock'].'</td>
                <td>'.$mensaje['punto_de_reorden'].'</td>
                <td>'.$mensaje['unidades_comprometidas'].'</td>
                <td>'.$mensaje['costo'].'</td>
                <td>'.$mensaje['url_imagen'].'</td>
                <td><a href="#" class="btn btn-success" style="background-color: pink;" onclick="editar('.$mensaje['id'].',\''.$mensaje['nombre'].'\',\''.$mensaje['descripcion'].'\',\''.$mensaje['precio'].'\',\''.$mensaje['unidades_en_stock'].'\',\''.$mensaje['punto_de_reorden'].'\',\''.$mensaje['unidades_comprometidas'].'\',\''.$mensaje['costo'].'\',\''.$mensaje['url_imagen'].'\')">Editar</a></td>
                <td><input type="button" class="btn btn-danger" value="Eliminar" onclick="eliminar('.$mensaje['id'].')"></td>
            </tr>';
        }
        return $response;
    }    
    
?>