const columns= [{
    data: 'idUsuario',
    name: 'idUsuario'
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
    data: 'dirUsuario',
    name: 'dirUsuario'
},
{
    data: 'docUsuario',
    name: 'docUsuario'
},
{
    data: 'idUsuario',
    name: 'idUsuario',
    orderable: false,
    searchable: false,
    render: function(data, type, row, meta) {
        return `<a href="javascript:void(0)"  data-id="${row.idUsuario}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idUsuario}" class="delete far fa-trash-alt text-danger"></a>`;
    }
}];

let tableUsuario = dataTable($('#dtUsuario'), `${base_url}/rrhh/usuario`, columns);