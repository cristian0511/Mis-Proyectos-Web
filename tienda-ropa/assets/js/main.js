// assets/js/main.js
$(document).ready(function() {
    
    // Inicialización adaptada y traducida de DataTables
    var table = $('#tablaModa').DataTable({
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' },
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "Todos"]],
        responsive: true
    });

    // CRUD: REGISTRAR PRODUCTO
    $('#formAgregar').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controllers/ProductoController.php?action=crear',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    $('#modalAgregar').modal('hide');
                    Swal.fire({ icon: 'success', title: '¡Completado!', text: response.message, showConfirmButton: false, timer: 1500 })
                    .then(() => { location.reload(); });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    // CRUD: VISTA DETALLADA (VER)
    $(document).on('click', '.btn-ver', function() {
        var idProducto = $(this).data('id');
        $.ajax({
            url: 'controllers/ProductoController.php?action=obtener',
            type: 'POST',
            data: { id: idProducto },
            dataType: 'json',
            success: function(response) {
                if(!response.error) {
                    $('#verTitulo').text(response.pro_descripcion);
                    $('#verImagenGrande').attr('src', 'uploads/' + (response.pro_imagen ? response.pro_imagen : 'default.jpg'));
                    $('#verCategoria').text(response.pro_categoria);
                    $('#verTalla').text(response.pro_talla);
                    $('#verColor').text(response.pro_color);
                    $('#verPrecio').text('$' + parseFloat(response.pro_precio_v).toFixed(2));
                    $('#verStock').text(response.pro_stock + ' unidades');
                    $('#modalVer').modal('show');
                }
            }
        });
    });

    // CRUD: PRECARGA DE DATOS PARA EDICIÓN
    $(document).on('click', '.btn-editar', function() {
        var idProducto = $(this).data('id');
        $.ajax({
            url: 'controllers/ProductoController.php?action=obtener',
            type: 'POST',
            data: { id: idProducto },
            dataType: 'json',
            success: function(response) {
                if(!response.error) {
                    $('#editId').val(response.pro_id);
                    $('#editDescripcion').val(response.pro_descripcion);
                    $('#editCategoria').val(response.pro_categoria);
                    $('#editTalla').val(response.pro_talla);
                    $('#editColor').val(response.pro_color);
                    $('#editPrecio').val(response.pro_precio_v);
                    $('#editStock').val(response.pro_stock);
                    $('#editImagenActual').val(response.pro_imagen);
                    $('#modalEditar').modal('show');
                }
            }
        });
    });

    // CRUD: CONFIRMAR ACTUALIZACIÓN
    $('#formEditar').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: 'controllers/ProductoController.php?action=editar',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    $('#modalEditar').modal('hide');
                    Swal.fire({ icon: 'success', title: '¡Actualizado!', text: response.message, showConfirmButton: false, timer: 1500 })
                    .then(() => { location.reload(); });
                } else {
                    Swal.fire('Información', response.message, 'info');
                }
            }
        });
    });

    // CRUD: CONFIRMACIÓN ESTRICTA Y ELIMINACIÓN
    $(document).on('click', '.btn-eliminar', function() {
        var idProducto = $(this).data('id');
        var nombrePrenda = $(this).data('name');

        Swal.fire({
            title: '¿Confirmar eliminación?',
            text: "Se borrará permanentemente de la base de datos: " + nombrePrenda,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#212529',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Sí, borrar registro',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'controllers/ProductoController.php?action=eliminar',
                    type: 'POST',
                    data: { id: idProducto },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire('¡Eliminado!', response.message, 'success');
                            $('#fila-' + idProducto).fadeOut('slow');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });
});