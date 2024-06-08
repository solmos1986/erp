var detallecompra = []

const columnsProducto = [{
    data: 'idProducto',
    name: 'idProducto'
},
{
    data: 'nomProducto',
    name: 'nomProducto',
    render: function (data, type, row, meta) {
        return `<p class='descripcion'>${row.nomProducto}</p>`;
    }
},
{
    data: 'stock',
    name: 'stock'
},
{
    data: 'nomUnidadMedida',
    name: 'nomUnidadMedida'
},
{
    data: 'idProducto',
    name: 'idProducto',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<i data-id="${row.idProducto}" class="addCart fas fa-shopping-cart text-success cursor-pointer"></i>`;
    }
},
];
const tableProductos = dataTable($('.dtProducto'), `${base_url}/almacen/producto/data-table`, columnsProducto)

$(document).on('click', '.addCart', function () {
    const idProducto = $(this).data('id');
    const data = tableProductos.rows().data().toArray().find((value) => value.idProducto ==
        idProducto);

    const validador = detallecompra.find(((item) => item.idProducto == data.idProducto));

    if (validador == undefined) {
        detallecompra.push({
            ...data,
            cantidad: 1,
            precio: 0,
            precioTotal: 0
        });
    } else {
        detallecompra.map(item => {
            if (item.idProducto == data.idProducto) {
                item.cantidad = item.cantidad + 1;
                item.precioTotal = parseFloat((item.precio * item.cantidad))
            }
        });
    }
    SumaTotales();
    renderDetalleVenta()
});

function renderDetalleVenta() {
    $('#dtOC').html('')
    let html = ``;
    detallecompra.forEach((item, i) => {
        html += `
            <tr id="fila${i}">
                <td style="min-width: 80px; max-width:200px; overflow: hidden; word-break: break-all;"><p class="">${item.codProducto}<br>${item.nomProducto}</p><input type="hidden" min="1" name="idProducto[]" value="${item.idProducto}" id="idProducto${i}" class="id form-control form-control-sm" placeholder="0" style="width: 90px;"></td>
                <td><input type="number" min="1" value="${item.cantidad}" data-id="${i}" name="cantidad[]" class="cantidad form-control form-control-sm" placeholder="0" style="width: 90px;"></td>
                <td><input type="number" min="1" value="${item.precio}" data-id="${i}" name="precio[]" class="precio form-control form-control-sm" placeholder="0" style="width: 90px;"></td>
                <td class="total${i}">${item.precioTotal}</td>
                <td class="delete${i}"><i data-id="${i}"  class="deleteItem fas fa-trash-alt text-danger"></i></td>
            </tr>
            `
    });
    $('#dtOC').append(html)
}
$(document).on('click', '.procesar', function () {
    const btn = $(this);
    btn.prop('disabled', true)
    const form_compra = $('#form_compra').serializeJSON();
    var dato = {
        ...form_compra,
        detallecompra: detallecompra,
    };
    console.log(dato)
    ajax(
        `${base_url}/comercial/compra`,
        "POST",
        dato
    ).then((response) => {
        if (response.status == 1) {
            Swal.fire({
                title: 'Desea imprimir?',
                text: "Esta proceso es irreversible",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, imprimir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    verPDF(response.data)
                } else {
                    window.location = "index";
                }
            })
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false)
        }
    })
});

$(document).on('keyup change', '.precio', function () {
    let precio = $(this).val();
    let posicion = $(this).data('id');
    let total = 0;
    detallecompra.map((item, i) => {
        if (i == posicion) {
            item.precioTotal = parseFloat(precio * item.cantidad);
            item.precio = parseFloat(precio);
            $(`.total${posicion}`).text(item
                .precioTotal); //restringir cantidad decimales
        }
        total += item.precioTotal
    })
    SumaTotales();
});

$(document).on('keyup change', '.cantidad', function () {
    let cantidad = $(this).val();
    let posicion = $(this).data('id');
    detallecompra.map((item, i) => {
        if (i == posicion) {
            item.precioTotal = parseFloat(item.precio * cantidad);
            item.cantidad = parseFloat(cantidad);
            $(`.total${posicion}`).text(item.precioTotal);
        }
    })
    SumaTotales();
});

$(document).on('change', '#idTipoComprobanteCreate', function () {
    //calcularImpuesto();
});

function calcularImpuesto() {
    console.log(impuesto)
    var impuesto = $("#idTipoComprobanteCreate").find(":selected").data("impuesto");
    var costoIns = $("#TotalCart").val();
    var tImpuesto = impuesto * costoIns;
    $('#impuestoEgresoCreate').val(tImpuesto);
}

function SumaTotales() {
    let total = 0;
    detallecompra.map((item, i) => {
        total += parseFloat(item.precioTotal);
        //$("#TotalCart").text(total);
    });
    $("#TotalCart").text(total);
    //calcularImpuesto();
}

$(document).on('click', '.deleteItem', function () {
    let posicion = $(this).data('id');
    let tr = document.querySelector('#fila' + posicion)
    tr.remove();
    detallecompra.splice(posicion, 1);
    SumaTotales();
    //renderDetalleVenta()
})

const onChangeSelect2Proveedor = function (e) {
}
select2(
    "#idProveedor",
    `${base_url}/almacen/proveedor/buscar`,
    "GET",
    onChangeSelect2Proveedor
);

//producto
$(document).on('click', '.creaProducto', function () {
    $("#form_product").trigger("reset");
    $('#modal_producto .modal-title').text('Nuevo producto');
    $('#modal_producto').modal('show');
    BtnAddSave($('#btn_save_producto'), 'store_producto', 'update_producto')
})
$(document).on('click', '.store_producto', function () {
    const btn = $(this);
    btn.prop('disabled', true);
    var formData = new FormData($('#form_product')[0]);
    formData.append('descripcion', createEditor.root.innerHTML);
    ajaxFormData(`${base_url}/almacen/producto`, 'POST', formData).then((response) => {
        if (response.status == '1') {
            SwallSuccess(response.message);
            btn.prop('disabled', false);
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
});


