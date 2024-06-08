
const createEditor = new Quill("#descripcion", {
    theme: "snow",
    modules: {
        toolbar: [
            ['bold', 'italic', 'underline', 'strike']
        ]
    }
})

$('#imagenProducto').dropify({
    messages: {
        default: "Arrastre y suelte un archivo aquí o haga clic",
        replace: " Arrastra y suelta o haz clic para reemplazar",
        remove: "Eliminar",
        error: "Vaya, se ha añadido algo mal.",
    },
    error: {
        fileSize: "El tamaño del archivo es demasiado grande (1 M como máximo)."
    },
});

$('#imagenProducto').dropify();

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    var formData = new FormData($('#form_product')[0]);
    formData.append('descripcion', createEditor.root.innerHTML);
    ajaxFormData(`${base_url}/almacen/producto/update/${$('#idProducto').val()}`, 'POST', formData).then((response) => {
        if (response.status == '1') {
            SwallSuccess(response.message);
            btn.prop('disabled', false);
            window.location = `${base_url}/almacen/producto`;
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
})
$(document).on("click", ".detalle_compra", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    $('#modal_tabla_compras .modal-title').text('Historial precios segun compra y ventas');
    ajaxFormData(`${base_url}/almacen/producto/data-table/${$('#idProducto').val()}`, 'GET').then((response) => {
        if (response.status == '1') {
            $('#tabla_compras').html('')
            $('#modal_tabla_compras').modal('show');
            let HTML = ``;
            response.data.compras.map((compra) => {
                HTML += `
                <tr>
                    <td>${compra.created_at == null ? 'no registrado' : compra.created_at}</td>
                    <td>${compra.idEgreso == null ? 'no registrado' : compra.idEgreso}</td>
                    <td>${compra.nomProducto}</td>
                    <td>${compra.cantidad_compra}</td>
                    <td>${compra.cantidad_venta}</td>
                    <td>${compra.precioCompra}</td>
                </tr>
                `;
            })
            $('#compra_promedio').html(`${response.data.promedio == null ? '' : response.data.promedio}`);
            $('#tabla_compras').append(HTML);
            btn.prop('disabled', false);
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
});
