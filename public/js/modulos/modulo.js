
const columnsModulo = [{
    data: 'nombre_modulo',
    name: 'nombre_modulo'
}, {
    data: 'url',
    name: 'url'
},
{
    data: 'class_icon',
    name: 'class_icon'
},
{
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

let tableModulo = dataTable($('.data-table-modulo'), `${base_url}/modulo/data-table`, columnsModulo);


$(document).on("click", ".nuevo_modulo", function () {
    const btn = $(this);
    console.log('editar')
    //const id = $(this).data('id');
    ajax(`${base_url}/modulo/create`, 'GET').then((response) => {
        btn.prop('disabled', false);
        $('#modal_modulo').modal('show');
        BtnAddSave($('#btn_save'), 'store_modulo', 'update_modulo')
        $('#modal_modulo .modal-title').text('Nuevo Modulo');
        const options = addOpcionModulo(response.data.super_modulos)
        $('#modal_modulo #select_super_modulo').html('')
        $('#modal_modulo #select_super_modulo').append(options)
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("change keyup", "#class_icon, #nombre_modulo", function () {
    const input = $('#form_modulo #class_icon').val();
    const nombre_modulo = $('#form_modulo #nombre_modulo').val();
    console.log(input)
    $('#form_modulo #icon_ejemplo').html('')
    $('#form_modulo #icon_ejemplo').html(`<i data-feather="${input}"></i> &nbsp; ${nombre_modulo}`)
    $('#form_modulo #icon_ejemplo').find('i').replaceWith(feather.icons[input].toSvg());
    //$('#form_modulo #icon_ejemplo').DOMRefresh();
});

$(document).on("click", ".store_modulo", function () {
    const btn = $(this);
    ajax(`${base_url}/modulo`, 'POST', $('#form_modulo').serialize()).then((response) => {
        btn.prop('disabled', false);
        $('#modal_modulo').modal('hide');
        tableModulo.ajax.url(`${base_url}/modulo/data-table`).load();
        SwallSuccess(response.message)
    }).catch(() => {
        btn.prop('disabled', false)

        SwallErrorValidate(response)
    });
});

function addOpcionModulo(options) {
    optionHTML = ``;
    options.map((o) => {
        optionHTML += `<option value="${o.super_modulo_id}">${o.nombre_super_modulo}</option>`;
    })
    return optionHTML;
}