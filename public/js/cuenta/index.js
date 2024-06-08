function espacios(orden_cuenta_id) {
    let espacio = ``;
    for (let index = 0; index < orden_cuenta_id; index++) {
        espacio += `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`;
    }
    return espacio;
}

const columnsCuenta = [{
    data: 'codigo_cuenta',
    name: 'codigo_cuenta',//orden_cuenta_id
    render: function (data, type, row, meta) {
        let espacio = espacios(row.orden_cuenta_id - 1);
        let text = '';
        switch (row.orden_cuenta_id) {
            case 1:
                text = `<b><u>${espacio}${row.codigo_cuenta}</u><b>`;
                break;
            case 2:
                text = `<b>${espacio}${row.codigo_cuenta}</b>`;
                break;
            case 3:
                text = `<i>${espacio}${row.codigo_cuenta}</i>`;
                break;
            case 4:
                text = `<strong>${espacio}${row.codigo_cuenta}</strong>`;
                break;
            default:
                text = `${espacio}${row.codigo_cuenta}`;
                break;
        }
        return text;
    }
},
{
    data: 'nombre_cuenta',
    name: 'nombre_cuenta',
    render: function (data, type, row, meta) {
        let espacio = espacios(row.orden_cuenta_id - 1);
        let text = '';
        switch (row.orden_cuenta_id) {
            case 1:
                text = `<b><u>${espacio}${row.nombre_cuenta}</u><b>`;
                break;
            case 2:
                text = `<b>${espacio}${row.nombre_cuenta}</b>`;
                break;
            case 3:
                text = `<i>${espacio}${row.nombre_cuenta}</i>`;
                break;
            case 4:
                text = `<strong>${espacio}${row.nombre_cuenta}</strong>`;
                break;
            default:
                text = `${espacio}${row.nombre_cuenta}`;
                break;
        }
        return text;
    }
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
        <i data-id="${row.cuenta_id}" class="sub_cuenta mdi mdi-plus-circle text-primary m-1 cursor-pointer" title="Ver Movimientos"></i>
        <i data-id="${row.cuenta_id}" class="ver_pdf fas fa-eye text-primary m-1 cursor-pointer" title="Ver Movimientos"></i>
        <i data-id="${row.cuenta_id}" class="edit fas fa-pencil-alt text-primary m-1 cursor-pointer" title="Editar"></i>
        <i data-id="${row.cuenta_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

const tableCuenta = dataTable($('#datatable_cuenta'),
    `${base_url}/cuenta/data-table`,
    columnsCuenta)