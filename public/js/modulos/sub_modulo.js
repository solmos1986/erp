
const columnsSubModulo = [{
    data: 'nombre_sub_modulo',
    name: 'nombre_sub_modulo'
},
{
    data: 'url',
    name: 'url'
},
{
    data: 'nombre_modulo',
    name: 'nombre_modulo'
},
{
    data: 'sub_modulo_id',
    name: 'sub_modulo_id',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
            <i data-id="${row.super_modulo_id}" class="editar fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
            <i data-id="${row.super_modulo_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

let tableSubModulo = dataTable($('.data-table-sub-modulo'), `${base_url}/sub-modulo/data-table`, columnsSubModulo);

$(document).on("click", ".nuevo_sub_modulo", function () {
    const btn = $(this);
    console.log('editar')
    //const id = $(this).data('id');
    btn.prop('disabled', false);
    ajax(`${base_url}/sub-modulo/create`, 'GET').then((response) => {
        $('#modal_sub_modulo').modal('show');
        BtnAddSave($('#btn_sub_save'), 'store_sub_modulo', 'update_sub_modulo')
        $('#modal_sub_modulo .modal-title').text('Nuevo sub modulo');
        const options = addOpcionModulo(response.data.modulos)
        $('#modal_sub_modulo #modulo_id').html('')
        $('#modal_sub_modulo #modulo_id').append(options)
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".store_sub_modulo", function () {
    const btn = $(this);
    ajax(`${base_url}/sub-modulo`, 'POST', $('#form_sub_modulo').serialize()).then((response) => {
        btn.prop('disabled', false);
        $('#modal_sub_modulo').modal('hide');
        tableSubModulo.ajax.url(`${base_url}/sub-modulo/data-table`).load();
        SwallErrorValidate(response)
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

function addOpcionModulo(options) {
    optionHTML = ``;
    options.map((o) => {
        optionHTML += `<option value="${o.modulo_id}">${o.nombre_modulo}</option>`;
    })
    return optionHTML;
}