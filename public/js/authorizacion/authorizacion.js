
const columns = [{
    data: 'docUsuario',
    name: 'docUsuario'
},
{
    data: 'nomUsuario',
    name: 'nomUsuario'
},
{
    data: 'telUsuario',
    name: 'telUsuario'
},
{
    data: 'mailUsuario',
    name: 'mailUsuario'
},
{
    data: 'usuario',
    name: 'usuario',
},
{
    data: 'estado',
    name: 'estado',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<div class="badge bg-${data.estado == 0 ? 'danger' : 'secondary'} text-light mb-0 m-1">${data.estado == 0 ? 'Inactivo' : 'Activo'}</div>`;
    }
},
{
    data: 'authenticacion_id',
    name: 'authenticacion_id',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
            <i data-id="${row.authenticacion_id}" class="editar fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
        `;
    }
}];

let tableUsusario = dataTable($('.data-table-usuario'), `${base_url}/authorizacion/data-table`, columns);
