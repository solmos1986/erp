const onChangeDesde = (selectedDates, dateStr, instance) => {
    tableCompras.ajax.url(`${base_url}/comercial/compra/data-table?startDate=${$('#startDate').val()}&endDate=${$('#endDate').val()}&idProveedor=${$('#idProveedor').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`,).load();
}
const onChangeFin = (selectedDates, dateStr, instance) => {
    tableCompras.ajax.url(`${base_url}/comercial/compra/data-table?startDate=${$('#startDate').val()}&endDate=${$('#endDate').val()}&idProveedor=${$('#idProveedor').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`,).load();
}

flatpickr($("#startDate"), moment().format("DD-MM-YYYY"), onChangeDesde)
flatpickr($("#endDate"), moment().format("DD-MM-YYYY"), onChangeFin)

const columns = [{
    data: 'idEgreso',
    name: 'idEgreso'
},
{
    data: 'created_at',
    name: 'created_at'
},
{
    data: 'nomProveedor',
    name: 'nomProveedor'
},
{
    data: 'nomTipoComprobante',
    name: 'nomTipoComprobante',
    render: function (data, type, row, meta) {
        return `<b>${row.nomTipoComprobante}</b> ${row.numComprobante}`;
    }
},
{
    data: 'nomMetodoPago',
    name: 'nomMetodoPago'
},
{
    data: 'total',
    name: 'total'
},
{
    data: 'nomUsuario',
    name: 'nomUsuario'
},
{
    data: 'nomEstado',
    name: 'nomEstado',
    render: function (data, type, row, meta) {
        return `<div class="badge bg-secondary text-light mb-0 m-1">${row.nomEstado.toUpperCase()}</div>`;
    }
},
{
    data: 'idEgreso',
    name: 'idEgreso',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
        <i data-id="${row.idEgreso}" data-estado="${row.estadoEgreso}" class="recibir fas fa-shopping-basket text-primary m-1 cursor-pointer" title="Recibir Orden"></i>
        <i data-id="${row.idEgreso}" class="ver_pdf fas fa-eye text-primary m-1 cursor-pointer" title="Ver pdf"></i>
        `;
    }
}];

const tableCompras = dataTable($('.dtEgresos'),
    `${base_url}/comercial/compra/data-table?startDate=${$('#startDate').val()}&endDate=${$('#endDate').val()}&idProveedor=${$('#idProveedor').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`,
    columns)

$(document).on('change', '.filtrar', function () {
    tableCompras.ajax.url(`${base_url}/comercial/compra/data-table?startDate=${$('#IngresoDesdeCompra').val()}&endDate=${$('#IngresoHastaCompra').val()}&idProveedor=${$('#idProveedor').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`).load();
});

$(document).on('click', '.recibir', function () {
    window.location = `${base_url}/entrada-almacen/create/${$(this).data('id') }`;
    /* if ($(this).data('estado') == 1) {
        
    }
    else {
        Swal.fire({
            title: 'Esta compra ya fue procesada esta seguro de modificar?',
            text: "Precaucion con productos ya vendidos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, editar!'
        }).then((result) => {
            if (result.isConfirmed) {
                //
            }
        })
    } */
});
