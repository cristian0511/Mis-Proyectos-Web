<?php
//Añadi '../' para que PHP salga de 'view' y encuentre la carpeta 'model'
require_once "../model/conectarDB.php";

$productos = [];
$error = null;

try {
    $conexion = conectaBaseDatos();
    $sql = "SELECT p.*, c.cat_nombre, m.mar_nombre 
            FROM productos p 
            LEFT JOIN categorias c ON p.cat_id = c.cat_id 
            LEFT JOIN marcas m ON p.mar_id = m.mar_id 
            ORDER BY c.cat_nombre, p.pro_descripcion ASC";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error al conectar a la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Productos</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <style>
        .header-box {
            background-color: hsla(219, 64%, 33%, 0.76);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }
        .producto-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
        }
        .badge-categoria {
            background-color: #17a2b8;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        .badge-disponible {
            background-color: #184486;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .badge-agotado {
            background-color: #f8d7da;
            color: #721c24;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container my-4">
        
        <div class="header-box shadow-sm">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-cart-shopping fa-2x me-3"></i>
                <div>
                    <h1 class="h3 mb-1 fw-bold">Gestión de Productos</h1>
                    <p class="mb-1 text-light-50">Panel de control de productos disponibles en la tienda</p>
                    <small class="text-light-50">NOMBRE: Cristian Flores</small>
                </div>
            </div>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> <?php echo $error; ?>
            </div>
        <?php else: ?>
            
            <div class="card shadow-sm border-0 p-4 bg-white rounded-3">
                <div class="table-responsive">
                    <table id="tablaProductos" class="table table-hover align-middle" style="width:100%">
                        <thead class="table-light text-secondary text-uppercase fs-7">
                            <tr>
                                <th>IMAGEN</th>
                                <th>CATEGORÍA</th>
                                <th>PRODUCTO</th>
                                <th>MARCA</th>
                                <th>PRECIO VENTA</th>
                                <th>STOCK</th>
                                <th>ESTADO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td>
                                        <img src="../img/<?php echo htmlspecialchars($producto['pro_imagen']); ?>" 
                                             alt="<?php echo htmlspecialchars($producto['pro_descripcion']); ?>" 
                                             class="producto-img border shadow-sm">
                                    </td>
                                    <td>
                                        <span class="badge-categoria">
                                            <i class="fa-solid fa-tag me-1"></i> <?php echo htmlspecialchars($producto['cat_nombre']); ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        <?php echo htmlspecialchars($producto['pro_descripcion']); ?>
                                    </td>
                                    <td class="text-muted">
                                        <?php echo htmlspecialchars($producto['mar_nombre']); ?>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        $<?php echo number_format($producto['pro_precio_v'], 2); ?>
                                    </td>
                                    <td class="text-primary fw-medium">
                                        <?php echo $producto['pro_stock'] . ' ' . htmlspecialchars($producto['pro_umedida']); ?>
                                    </td>
                                    <td>
                                        <?php if ($producto['pro_stock'] > 0): ?>
                                            <span class="badge-disponible">
                                                <i class="fa-solid fa-circle-check me-1"></i> Disponible
                                            </span>
                                        <?php else: ?>
                                            <span class="badge-agotado">
                                                <i class="fa-solid fa-circle-xmark me-1"></i> Agotado
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaProductos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                pageLength: 10,
                lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
                order: [[2, 'asc']], // Ordenar por la columna Producto
                responsive: true
            });
        });
    </script>
</body>
</html>