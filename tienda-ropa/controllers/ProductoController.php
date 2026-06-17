<?php
// controllers/ProductoController.php
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

require_once __DIR__ . "/../models/ProductoModel.php";

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'obtener':
        if (isset($_POST['id'])) {
            $producto = ProductoModel::obtenerPorId($_POST['id']);
            echo json_encode($producto ? $producto : ['error' => 'No se encontró el registro.']);
        }
        break;

    case 'crear':
        try {
            $nombreImagen = "default.jpg"; 
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $filename = $_FILES['imagen']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $nombreImagen = time() . "." . $ext; 
                move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . "/../uploads/" . $nombreImagen);
            }

            $res = ProductoModel::guardar(
                $_POST['descripcion'], 
                $_POST['categoria'], 
                $_POST['talla'], 
                $_POST['color'], 
                $_POST['precio'], 
                $_POST['stock'], 
                $nombreImagen
            );
            
            echo json_encode($res ? ['status' => 'success', 'message' => '¡Prenda registrada exitosamente!'] : ['status' => 'error', 'message' => 'Error interno al procesar el guardado.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    case 'editar':
        try {
            $nombreImagen = $_POST['imagen_actual'];
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $filename = $_FILES['imagen']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $nombreImagen = time() . "." . $ext;
                move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . "/../uploads/" . $nombreImagen);
            }

            $res = ProductoModel::actualizar(
                $_POST['id'], 
                $_POST['descripcion'], 
                $_POST['categoria'], 
                $_POST['talla'], 
                $_POST['color'], 
                $_POST['precio'], 
                $_POST['stock'], 
                $nombreImagen
            );
            
            echo json_encode($res ? ['status' => 'success', 'message' => '¡Registro actualizado con éxito!'] : ['status' => 'error', 'message' => 'No se detectaron modificaciones en el formulario.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    case 'eliminar':
        if (isset($_POST['id'])) {
            $res = ProductoModel::eliminar($_POST['id']);
            echo json_encode($res ? ['status' => 'success', 'message' => 'El registro ha sido removido de forma física del inventario.'] : ['status' => 'error', 'message' => 'No se pudo completar la acción.']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Punto de entrada o acción no mapeada.']);
        break;
}
ob_end_flush();
?>