
const columnsSuperModulo = [{
    data: 'nombre_super_modulo',
    name: 'nombre_super_modulo'
},
{
    data: 'super_modulo_id',
    name: 'super_modulo_id',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
            <i data-id="${row.super_modulo_id}" class="editar fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
            <i data-id="${row.super_modulo_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

$(document).ready(function () {
    let tableSuperModulo = dataTable($('.data-table-super-modulo'), `${base_url}/super-modulo/data-table`, columnsSuperModulo);
});

$(document).on("click", ".editar", function () {
    const btn = $(this);
    console.log('editar')
    const id = $(this).data('id');
    btn.prop('disabled', true);
    $('#modal_authorizacion .modal-title').text('Editar Authenticacion');
    ajax(`${base_url}/authorizacion/${id}`, 'GET').then((response) => {
        btn.prop('disabled', false);
        data = response.data;
        BtnAddUpdate($('#btn_save'), 'store', 'update')
        $('#modal_authorizacion').modal('show');
    }).catch(() => {
        btn.prop('disabled', false)
    });
});
