<?php
// view/productos/listar.php
require_once __DIR__ . "/../../model/ProductoModel.php";

$model = new ProductoModel();
$productos = $model->listarTodos(); // Asegúrate de tener este método en tu modelo
?>

<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-dark m-0">
                <i class="fa-solid fa-boxes-stacked me-2 text-primary"></i>Panel de Control de Productos
            </h3>
            <button type="button" class="btn btn-success px-3 fw-medium shadow-sm" data-bs-toggle="modal" data-bs-target="#modalNuevoProducto">
                <i class="fa-solid fa-plus me-2"></i>Nuevo Producto
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle border-light">
                <thead class="table-dark text-uppercase fs-7">
                    <tr>
                        <th class="text-center" style="width: 100px;">Imagen</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th class="text-center">Talla</th>
                        <th class="text-center">Color</th>
                        <th class="text-end">Precio</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center" style="width: 150px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $row): ?>
                            <tr>
                                <td class="text-center">
                                    <?php 
                                    $foto = (!empty($row['pro_imagen'])) ? $row['pro_imagen'] : 'default.jpg'; 
                                    ?>
                                    <img src="uploads/<?php echo $foto; ?>" class="img-thumbnail rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="fw-medium text-secondary"><?php echo htmlspecialchars($row['pro_descripcion']); ?></td>
                                <td><span class="badge bg-info text-dark px-2.5 py-1.5"><?php echo htmlspecialchars($row['pro_categoria']); ?></span></td>
                                <td class="text-center fw-semibold"><?php echo htmlspecialchars($row['pro_talla']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['pro_color']); ?></td>
                                <td class="text-end fw-bold text-dark">$<?php echo number_format($row['pro_precio_v'], 2); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?php echo $row['pro_stock']; ?> u.</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-info btn-ver-producto" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalVerProducto"
                                                data-descripcion="<?php echo htmlspecialchars($row['pro_descripcion']); ?>"
                                                data-categoria="<?php echo htmlspecialchars($row['pro_categoria']); ?>"
                                                data-talla="<?php echo htmlspecialchars($row['pro_talla']); ?>"
                                                data-color="<?php echo htmlspecialchars($row['pro_color']); ?>"
                                                data-precio="<?php echo $row['pro_precio_v']; ?>"
                                                data-stock="<?php echo $row['pro_stock']; ?>"
                                                data-imagen="<?php echo $foto; ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>

                                        <button type="button" class="btn btn-sm btn-outline-warning btn-editar-producto" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalEditarProducto"
                                                data-id="<?php echo $row['pro_id']; ?>"
                                                data-descripcion="<?php echo htmlspecialchars($row['pro_descripcion']); ?>"
                                                data-categoria="<?php echo htmlspecialchars($row['pro_categoria']); ?>"
                                                data-talla="<?php echo htmlspecialchars($row['pro_talla']); ?>"
                                                data-color="<?php echo htmlspecialchars($row['pro_color']); ?>"
                                                data-precio="<?php echo $row['pro_precio_v']; ?>"
                                                data-stock="<?php echo $row['pro_stock']; ?>"
                                                data-imagen="<?php echo $foto; ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <a href="index.php?page=productos&action=eliminar&id=<?php echo $row['pro_id']; ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('¿Estás completamente seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.');">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">No hay prendas registradas en el inventario actualmente.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php 
// Incluimos de forma segura los modales hijos que se activarán con los clics
include_once "nuevo.php"; 
include_once "editar.php"; 
include_once "ver.php"; 
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // LÓGICA MODAL VER (OJO)
    const botonesVer = document.querySelectorAll('.btn-ver-producto');
    botonesVer.forEach(boton => {
        boton.addEventListener('click', function() {
            document.getElementById('ver-descripcion').textContent = this.dataset.descripcion;
            document.getElementById('ver-categoria').textContent = this.dataset.categoria;
            document.getElementById('ver-talla').textContent = this.dataset.talla;
            document.getElementById('ver-color').textContent = this.dataset.color;
            document.getElementById('ver-precio').textContent = parseFloat(this.dataset.precio).toFixed(2);
            document.getElementById('ver-stock').textContent = this.dataset.stock + " u.";
            document.getElementById('ver-imagen').src = "uploads/" + this.dataset.imagen;
        });
    });

    // LÓGICA MODAL EDITAR (LÁPIZ)
    const botonesEditar = document.querySelectorAll('.btn-editar-producto');
    botonesEditar.forEach(boton => {
        boton.addEventListener('click', function() {
            document.getElementById('edit-id').value = this.dataset.id;
            document.getElementById('edit-descripcion').value = this.dataset.descripcion;
            document.getElementById('edit-categoria').value = this.dataset.categoria;
            document.getElementById('edit-talla').value = this.dataset.talla;
            document.getElementById('edit-color').value = this.dataset.color;
            document.getElementById('edit-precio').value = this.dataset.precio;
            document.getElementById('edit-stock').value = this.dataset.stock;
            document.getElementById('edit-preview').src = "uploads/" + this.dataset.imagen;
        });
    });
});
</script>