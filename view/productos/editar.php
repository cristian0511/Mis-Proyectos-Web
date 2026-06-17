<div class="modal fade" id="modalEditarProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <form action="index.php?page=productos&action=actualizar" method="POST" enctype="multipart/form-data">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Editar Información del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="pro_id" id="edit-id">
                    
                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary">Descripción de la Prenda</label>
                                <input type="text" class="form-control" name="pro_descripcion" id="edit-descripcion" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Categoría</label>
                                    <select class="form-select" name="pro_categoria" id="edit-categoria" required>
                                        <option value="Camisetas">Camisetas</option>
                                        <option value="Pantalones">Pantalones</option>
                                        <option value="Abrigos">Abrigos</option>
                                        <option value="Vestidos">Vestidos</option>
                                        <option value="Camisas">Camisas</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Talla</label>
                                    <input type="text" class="form-control" name="pro_talla" id="edit-talla" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Color</label>
                                    <input type="text" class="form-control" name="pro_color" id="edit-color" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Precio ($)</label>
                                    <input type="number" step="0.01" class="form-control" name="pro_precio_v" id="edit-precio" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold small text-secondary">Stock</label>
                                    <input type="number" class="form-control" name="pro_stock" id="edit-stock" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 border-start text-center d-flex flex-column justify-content-center">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-secondary d-block">Imagen Actual</label>
                                <img id="edit-preview" src="uploads/default.jpg" class="img-fluid rounded border shadow-sm mb-2" style="max-height: 140px; object-fit: contain;">
                            </div>
                            <div class="mb-2">
                                <label class="form-label fw-bold small text-muted">Subir nueva foto:</label>
                                <input class="form-control form-control-sm" type="file" name="pro_imagen" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning px-4 fw-medium">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>