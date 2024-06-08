const onChangeDesde = (selectedDates, dateStr, instance) => {
    tableLibroDiario.ajax.url(`${base_url}/libro-diario/data-table-libro-diario?desde=${$('#MovimientoDesde').val()}&hasta=${$('#MovimientoHasta').val()}`).load();
}
const onChangeFin = (selectedDates, dateStr, instance) => {
    tableLibroDiario.ajax.url(`${base_url}/libro-diario/data-table-libro-diario?desde=${$('#MovimientoDesde').val()}&hasta=${$('#MovimientoHasta').val()}`).load();
}

flatpickr($("#MovimientoDesde"), moment().format("DD-MM-YYYY"), onChangeDesde)
flatpickr($("#MovimientoHasta"), moment().format("DD-MM-YYYY"), onChangeFin)

/* $(document).on('change', '#idTipoMovimiento', function () {
    tableLibroDiario.ajax.url(`${base_url}/libro-diario/data-table-libro-diario?desde=${$('#MovimientoDesde').val()}&hasta=${$('#MovimientoHasta').val()}`).load();
});
 */
const columnslibroDiario = [
    {
        data: 'created_at',
        name: 'created_at'
    },
    {
        data: 'nomMovimiento',
        name: 'nomMovimiento'
    },
    {
        data: 'razon_social',
        name: 'razon_social'
    },
    {
        data: 'descripcion',
        name: 'descripcion',
        render: function (data, type, row, meta) {
            return `<p class='descripcion'>${salto_linea(row.descripcion)}</p>`;
        }
    },
    {
        data: 'totalMov',
        name: 'totalMov'
    },
    {
        data: 'idMovimiento',
        name: 'idMovimiento',
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
            return `
            <i data-id="${row.idMovimiento}" class="ver_movimiento fas fa-eye text-primary m-1 cursor-pointer" title="Ver movimiento"></i>
            `;
        }
    }];

const tableLibroDiario = dataTable($('#dataTableLibroDiario'),
    `${base_url}/libro-diario/data-table-libro-diario`,
    columnslibroDiario)

$(document).on('click', '.todo_movimientos', function () {
    $('#modal_table_libro_diario .modal-title').text('Lista de asientos');
    $('#modal_table_libro_diario').modal('show');
});

$(document).on('click', '.ver_movimiento', function () {
    const idMovimiento = $(this).data('id');
    $('#idMovimiento').val(idMovimiento);
    cargarMovimiento()
});

function cargarMovimiento() {
    $('#modal_table_libro_diario').modal('hide');
    ajax(
        `${base_url}/libro-diario/${$('#idMovimiento').val()}`,
        "GET"
    ).then((response) => {
        $('#razon_social').val(response.data.razon_social);
        $('#numComprobante').val(response.data.numComprobante);
        $('#nomMovimiento').val(response.data.nomMovimiento);
        $('#descripcion').val(response.data.descripcion);
    })
    tableMovimiento.ajax.url(`${base_url}/libro-diario/data-table-movimiento/${$('#idMovimiento').val()}`).load();
}

$(document).ready(function () {
    cargarMovimiento()
});
