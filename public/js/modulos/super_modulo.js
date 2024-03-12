
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

let tableSuperModulo = dataTable($('.data-table-super-modulo'), `${base_url}/super-modulo/data-table`, columnsSuperModulo);

$(document).on("click", ".nuevo_super_modulo", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    $('#modal_super_modulo .modal-title').text('Nueva seccion');
    btn.prop('disabled', false);
    BtnAddSave($('#btn_super_save'), 'store_super_modulo', 'update_super_modulo')
    $('#modal_super_modulo').modal('show');
});

$(document).on("click", ".store_super_modulo", function () {
    const btn = $(this);
    ajax(`${base_url}/super-modulo`, 'POST', $('#form_super_modulo').serialize()).then((response) => {
        btn.prop('disabled', false);
        $('#modal_super_modulo').modal('hide');
        tableSuperModulo.ajax.url(`${base_url}/super-modulo/data-table`).load();
        SwallErrorValidate(response)
    }).catch(() => {
        btn.prop('disabled', false)
    });
});