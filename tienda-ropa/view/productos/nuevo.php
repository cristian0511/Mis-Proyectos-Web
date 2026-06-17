<div class="modal fade" id="modalNuevoProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <form action="index.php?page=productos&action=guardar" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-plus me-2"></i>Registrar Nueva Prenda</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Descripción del Producto</label>
                                <input type="text" class="form-control" name="pro_descripcion" placeholder="Ej. Camiseta Polo Casual" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Categoría</label>
                                    <select class="form-select" name="pro_categoria" required>
                                        <option value="" disabled selected>Seleccione...</option>
                                        <option value="Camisetas">Camisetas</option>
                                        <option value="Pantalones">Pantalones</option>
                                        <option value="Abrigos">Abrigos</option>
                                        <option value="Vestidos">Vestidos</option>
                                        <option value="Camisas">Camisas</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Talla</label>
                                    <input type="text" class="form-control" name="pro_talla" placeholder="Ej. M, L, 32" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Color</label>
                                    <input type="text" class="form-control" name="pro_color" placeholder="Ej. Negro" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Precio de Venta ($)</label>
                                    <input type="number" step="0.01" class="form-control" name="pro_precio_v" placeholder="0.00" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Stock Inicial</label>
                                    <input type="number" class="form-control" name="pro_stock" placeholder="0" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 border-start text-center d-flex flex-column justify-content-center align-items-center bg-light rounded-2 p-3">
                            <i class="fa-solid fa-image text-muted mb-2" style="font-size: 3rem;"></i>
                            <label class="form-label fw-bold small text-secondary mb-2">Imagen de la Prenda</label>
                            <input class="form-control form-control-sm" type="file" name="pro_imagen" accept="image/*" required>
                            <div class="form-text small text-muted mt-1">Selecciona una foto desde tu computadora.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success px-4 fw-medium">Registrar Prenda</button>
                </div>
            </form>
        </div>
    </div>
</div>