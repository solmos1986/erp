$('#idTipoMovimiento').select2({
    multiple: true,
});

const columns = [
    {
        data: 'codigo_cuenta',
        name: 'codigo_cuenta'
    },
    {
        data: 'nombre_cuenta',
        name: 'nombre_cuenta'
    },
    {
        data: 'descripcion',
        name: 'descripcion',
        render: function (data, type, row, meta) {
            return `<p class='descripcion'>${salto_linea(row.descripcion)}</p>`;
        }
    },
    {
        data: 'debe',
        name: 'debe'
    },
    {
        data: 'haber',
        name: 'haber'
    }];

const tableMovimiento = dataTable($('#dataTableMovimiento'),
    `${base_url}/libro-diario/data-table-movimiento/${$('#idMovimiento').val()}`,
    columns)
