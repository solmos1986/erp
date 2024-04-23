const columnsCuenta = [{
    data: 'codigo_cuenta',
    name: 'codigo_cuenta'
},
{
    data: 'nombre_cuenta',
    name: 'nombre_cuenta'
},
{
    data: 'debe',
    name: 'debe'
},
{
    data: 'haber',
    name: 'haber',
},
{
    data: 'saldo',
    name: 'saldo'
},
{
    data: 'cuenta_id',
    name: 'cuenta_id',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
        <i data-id="${row.cuenta_id}" class="ver_pdf fas fa-eye text-primary m-1 cursor-pointer" title="Ver Movimientos"></i>
        <i data-id="${row.cuenta_id}" class="edit fas fa-pencil-alt text-primary m-1 cursor-pointer" title="Editar"></i>
        <i data-id="${row.cuenta_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

const tableCuenta = dataTable($('#datatable_cuenta'),
    `${base_url}/cuenta/data-table`,
    columnsCuenta)