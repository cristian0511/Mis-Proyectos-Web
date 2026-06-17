<?php
// index.php - Controlador Frontal Principal con Procesador de Base de Datos Integrado
require_once __DIR__ . "/model/ProductoModel.php";
$model = new ProductoModel();

// Capturamos la página y la acción solicitada de forma segura
$page = isset($_GET['page']) ? $_GET['page'] : 'portada';
$action = isset($_GET['action']) ? $_GET['action'] : '';

// ==========================================
// ⚡ PROCESADOR DE ACCIONES (INSERT, UPDATE, DELETE)
// ==========================================
if ($page == 'productos' && !empty($action)) {
    
    // 1. GUARDAR NUEVO PRODUCTO
    if ($action == 'guardar' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $descripcion = $_POST['pro_descripcion'];
        $categoria   = $_POST['pro_categoria'];
        $talla       = $_POST['pro_talla'];
        $color       = $_POST['pro_color'];
        $precio      = $_POST['pro_precio_v'];
        $stock       = $_POST['pro_stock'];
        $nombre_foto = 'default.jpg'; // Imagen por defecto si no suben nada

        // Procesar subida de archivo desde la computadora
        if (isset($_FILES['pro_imagen']) && $_FILES['pro_imagen']['error'] == 0) {
            $ext = pathinfo($_FILES['pro_imagen']['name'], PATHINFO_EXTENSION);
            // Creamos un nombre único para evitar que fotos con el mismo nombre se borren
            $nombre_foto = time() . "_" . bin2hex(random_bytes(4)) . "." . $ext;
            $ruta_destino = __DIR__ . "/uploads/" . $nombre_foto;
            
            // Movemos el archivo temporal a nuestra carpeta permanente
            move_uploaded_file($_FILES['pro_imagen']['tmp_name'], $ruta_destino);
        }

        // Llamamos al modelo para insertar (Adapta estos nombres a los de tu ProductoModel si varían)
        if (method_exists($model, 'insertar')) {
            $model->insertar($descripcion, $categoria, $talla, $color, $precio, $stock, $nombre_foto);
        } elseif (method_exists($model, 'guardar')) {
            $model->guardar($descripcion, $categoria, $talla, $color, $precio, $stock, $nombre_foto);
        }
        
        // Redirección limpia para refrescar la tabla y evitar duplicados al actualizar
        header("Location: index.php?page=productos");
        exit();
    }

    // 2. ACTUALIZAR PRODUCTO EXISTENTE
    if ($action == 'actualizar' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $id          = $_POST['pro_id'];
        $descripcion = $_POST['pro_descripcion'];
        $categoria   = $_POST['pro_categoria'];
        $talla       = $_POST['pro_talla'];
        $color       = $_POST['pro_color'];
        $precio      = $_POST['pro_precio_v'];
        $stock       = $_POST['pro_stock'];

        // Recuperar los datos actuales para mantener la imagen vieja si no se sube una nueva
        $nombre_foto = null;
        if (method_exists($model, 'buscarPorId')) {
            $prodActual = $model->buscarPorId($id);
            $nombre_foto = $prodActual['pro_imagen'] ?? 'default.jpg';
        }

        // Si el usuario subió una nueva imagen desde su PC, la reemplazamos
        if (isset($_FILES['pro_imagen']) && $_FILES['pro_imagen']['error'] == 0) {
            $ext = pathinfo($_FILES['pro_imagen']['name'], PATHINFO_EXTENSION);
            $nombre_foto = time() . "_edit_" . bin2hex(random_bytes(4)) . "." . $ext;
            $ruta_destino = __DIR__ . "/uploads/" . $nombre_foto;
            move_uploaded_file($_FILES['pro_imagen']['tmp_name'], $ruta_destino);
        }

        // Llamamos al modelo para actualizar en MySQL
        if (method_exists($model, 'actualizar')) {
            $model->actualizar($id, $descripcion, $categoria, $talla, $color, $precio, $stock, $nombre_foto);
        } elseif (method_exists($model, 'modificar')) {
            $model->modificar($id, $descripcion, $categoria, $talla, $color, $precio, $stock, $nombre_foto);
        }

        header("Location: index.php?page=productos");
        exit();
    }

    // 3. ELIMINAR PRODUCTO
    if ($action == 'eliminar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        if (method_exists($model, 'eliminar')) {
            $model->eliminar($id);
        } elseif (method_exists($model, 'borrar')) {
            $model->borrar($id);
        }

        header("Location: index.php?page=productos");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Store - Sistema de Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php?page=portada">
                <i class="fa-solid fa-shirt me-2 text-info"></i>FASHION STORE
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'portada') ? 'active fw-bold text-info' : ''; ?>" href="index.php?page=portada">
                            <i class="fa-solid fa-house me-1"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($page == 'productos') ? 'active fw-bold text-info' : ''; ?>" href="index.php?page=productos">
                            <i class="fa-solid fa-boxes-stacked me-1"></i>Inventario
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4" style="padding-bottom: 70px;">
        <?php
        switch ($page) {
            case 'portada':
                $archivo = "view/inicio.php";
                break;
            case 'productos':
                $archivo = "view/productos/listar.php";
                break;
            default:
                $archivo = "view/inicio.php";
                break;
        }

        if (file_exists($archivo)) {
            include $archivo;
        } else {
            echo "<div class='alert alert-danger'>Módulo no disponible ($archivo)</div>";
        }
        ?>
    </main>

    <footer class="bg-dark text-white text-center py-3 fixed-bottom border-top border-secondary">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 | Taller Práctico Grupal - Programación de Aplicaciones Web - Patrón MVC</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>