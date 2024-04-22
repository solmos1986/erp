const onChangeDesde = (selectedDates, dateStr, instance) => {
    tableVentas.ajax.url(`${base_url}/comercial/venta/data-table?IngresoDesde=${$('#IngresoDesde').val()}&IngresoHasta=${$('#IngresoHasta').val()}&idCliente=${$('#idCliente').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`).load();
}
const onChangeFin = (selectedDates, dateStr, instance) => {
    tableVentas.ajax.url(`${base_url}/comercial/venta/data-table?IngresoDesde=${$('#IngresoDesde').val()}&IngresoHasta=${$('#IngresoHasta').val()}&idCliente=${$('#idCliente').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`).load();
}

flatpickr($("#IngresoDesde"), moment().format("YYYY-MM-DD"), onChangeDesde)
flatpickr($("#IngresoHasta"), moment().format("YYYY-MM-DD"), onChangeFin)

const columns = [{
    data: 'idIngreso',
    name: 'idIngreso'
},
{
    data: 'fechaIngreso',
    name: 'fechaIngreso'
},
{
    data: 'nomCliente',
    name: 'nomCliente'
},
{
    data: 'nomTipoComprobante',
    name: 'nomTipoComprobante',
    render: function (data, type, row, meta) {
        return `<b>${row.nomTipoComprobante}</b> ${row.idIngreso}`;
    }
},
{
    data: 'impuestoIngreso',
    name: 'impuestoIngreso'
},
{
    data: 'nomTipoPago',
    name: 'nomTipoPago'
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
    name: 'nomEstado'
},
{
    data: 'idIngreso',
    name: 'idIngreso',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<i data-id="${row.idIngreso}" class="ver_pdf fas fa-eye text-info m-1 cursor-pointer" title="Ver pdf"></i>`;
    }
}];
const tableVentas = dataTable($('.dtIngresos'),
    `${base_url}/comercial/venta/data-table?IngresoDesde=${$('#IngresoDesde').val()}&IngresoHasta=${$('#IngresoHasta').val()}&idCliente=${$('#idCliente').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`,
    columns)

$(document).on('keyup change', '.filtrar', function () {
    tableVentas.ajax.url(`${base_url}/comercial/venta/data-table?IngresoDesde=${$('#IngresoDesde').val()}&IngresoHasta=${$('#IngresoHasta').val()}&idCliente=${$('#idCliente').val()}&idTipoComprobante=${$('#idTipoComprobante').val()}&idTipoPago=${$('#idTipoPago').val()}&idUsuario=${$('#idUsuario').val()}`).load();
});