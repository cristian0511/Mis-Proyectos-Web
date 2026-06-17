<div class="modal fade" id="modalVerProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-eye me-2"></i>Vista Ampliada del Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center mb-3 mb-md-0">
                        <img id="ver-imagen" src="uploads/default.jpg" class="img-fluid rounded shadow border" style="max-height: 300px; width: 100%; object-fit: contain;" alt="Imagen del producto">
                    </div>
                    <div class="col-md-7">
                        <h4 id="ver-descripcion" class="fw-bold text-primary mb-3">Descripción de la prenda</h4>
                        <hr class="text-muted my-2">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between p-2">
                                <span class="text-muted"><i class="fa-solid fa-tags me-2"></i>Categoría:</span>
                                <span id="ver-categoria" class="fw-bold text-dark">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-2">
                                <span class="text-muted"><i class="fa-solid fa-ruler me-2"></i>Talla:</span>
                                <span id="ver-talla" class="fw-bold text-dark">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-2">
                                <span class="text-muted"><i class="fa-solid fa-palette me-2"></i>Color:</span>
                                <span id="ver-color" class="fw-bold text-dark">-</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-2">
                                <span class="text-muted"><i class="fa-solid fa-dollar-sign me-2"></i>Precio Unitario:</span>
                                <span class="text-success fw-bold fs-5">$<span id="ver-precio">0.00</span></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between p-2">
                                <span class="text-muted"><i class="fa-solid fa-warehouse me-2"></i>Stock Disponible:</span>
                                <span id="ver-stock" class="badge bg-dark px-2">0 u.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>