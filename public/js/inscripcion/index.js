const columns = [{
    data: 'idDetalleInscripcion',
    name: 'idDetalleInscripcion'
},
{
    data: 'created_at',
    name: 'created_at'
},
{
    data: 'nomCliente',
    name: 'nomCliente'
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
    data: 'costoPaquete',
    name: 'costoPaquete'
},
{
    data: 'nomUsuario',
    name: 'nomUsuario'
},
{
    data: 'fechaInicio',
    name: 'fechaInicio',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `${row.fechaInicio} <br> ${row.fechaFin} `;
    }
},
{
    data: 'estadoInscripcion',
    name: 'estadoInscripcion',
    render: function (data, type, row, meta) {
        return estadoInscripcion(row.estadoInscripcion);
    }
},
{
    data: 'idIngreso',
    name: 'idIngreso',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<i data-id="${row.idDetalleInscripcion}" class="ver_pdf fas fa-eye text-primary m-1 cursor-pointer" title="Ver pdf"></i>`;
    }
},
];
const table = dataTable($('.dtInscripciones'),
    `${base_url}/comercial/inscripcion?startDate=${$('#IngresoDesdeIns').val() + 'T00:00:00'}&endDate=${$('#IngresoHastaIns').val() + 'T23:59:59'}&idCliente=${$('#idClienteIns').val()}&idTipoPago=${$('#idTipoPagoIns').val()}&idTipoComprobante=${$('#idTipoComprobanteIns').val()}&idUsuario=${$('#idUsuarioIns').val()}`,
    columns)

$(document).on('keyup change', '.filtrar', function () {
    table.ajax.url(
        `${base_url}/comercial/inscripcion?startDate=${$('#IngresoDesdeIns').val() + 'T00:00:00'}&endDate=${$('#IngresoHastaIns').val() + 'T23:59:59'}&idCliente=${$('#idClienteIns').val()}&idTipoPago=${$('#idTipoPagoIns').val()}&idTipoComprobante=${$('#idTipoComprobanteIns').val()}&idUsuario=${$('#idUsuarioIns').val()}`,
    ).load();
});

select2(
    "#idClienteIns",
    `${base_url}/clientes/buscar-nombre`,
    "GET",
    () => { }
);

$(document).on('click', '#limpiar_equipos', function () {
    const btn = $(this);
    btn.prop('disable', true)
    ajax(`${base_url}/comercial/eliminar-cliente-automatico`, 'GET').catch(
        (response) => {
            console.log(response)
        }
    )
});

$(document).on('click', '.ver_pdf', function () {
    const id = $(this).data('id')
    console.log('open modal')
    verPDF(id)
});

function verPDF(id) {
    var frame = $("#iframePDF");
    var ahref = $("#cancelPDF");
    //LOADER
    ajax(`${base_url}/comercial/inscripcion-pdf/${id}`, "GET").then(
        (response) => {
            var src = `data:application/pdf;base64,${response.data}`;
            $("#modalImprimir .modal-title").text("RECIBO DE INSCRIPCION");
            ahref.attr("href", `${base_url}/comercial/inscripcion/index`);
            frame.attr("src", `data:application/pdf;base64,${response.data}`);
            $("#modalImprimir").modal("show");
            $("#iframePDF").data("url", response.data);
        }
    );
}

function estadoInscripcion(estado) {
    switch (estado) {
        case 'ven':
            return `<div class="badge bg-secondary text-light mb-0 m-1">VENCIDO</div>`;
            break;
        case 'vig':
            return `<div class="badge bg-secondary text-light mb-0 m-1">VIGENTE</div>`;
            break;
        case 'ant':
            return `<div class="badge bg-secondary text-light mb-0 m-1">ANTICIPADO</div>`;
            break;
    }
}