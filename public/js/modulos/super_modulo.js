
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
            <i data-id="${row.super_modulo_id}" class="editar_super_modulo fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
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
    $('#form_super_modulo').trigger("reset");
});

$(document).on("click", ".store_super_modulo", function () {
    const btn = $(this);
    ajax(`${base_url}/super-modulo`, 'POST', $('#form_super_modulo').serialize()).then((response) => {
        btn.prop('disabled', false);
        $('#modal_super_modulo').modal('hide');
        tableSuperModulo.ajax.url(`${base_url}/super-modulo/data-table`).load();
        SwallErrorValidate(response);
        $('#form_super_modulo').trigger("reset");
    }).catch(() => {
        btn.prop('disabled', false)
    });
});


$(document).on("click", ".editar_super_modulo", function () {
    const btn = $(this);
    const id = $(this).data('id');
    ajax(`${base_url}/super-modulo/${id}`, 'GET').then((response) => {
        btn.prop('disabled', false);
        $('#modal_super_modulo .modal-title').text('Editar seccion');
        $('#modal_super_modulo').modal('show');
        $('#form_super_modulo #super_modulo_id').val(response.data.super_modulo.super_modulo_id)
        $('#form_super_modulo #nombre_super_modulo').val(response.data.super_modulo.nombre_super_modulo)
        BtnAddUpdate($('#btn_super_save'), 'store_super_modulo', 'update_super_modulo');
    });
});

$(document).on("click", ".update_super_modulo", function () {
    const btn = $(this);
    ajax(`${base_url}/super-modulo/${$('#super_modulo_id').val()}`, 'PUT', $('#form_super_modulo').serialize()).then((response) => {
        btn.prop('disabled', false);
        $('#modal_super_modulo').modal('hide');
        console.log(response)
        tableSuperModulo.ajax.url(`${base_url}/super-modulo/data-table`).load();
        SwallErrorValidate(response);
        $('#form_super_modulo').trigger("reset");
    });
});

$(document).on("click", ".delete", function () {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "Esta proceso es irreversible",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar esto!'
    }).then((result) => {
        if (result.isConfirmed) {
            eliminar(id)
        }
    })
});


function eliminar(id) {
    ajax(`${base_url}/super-modulo/${id}`, 'DELETE').then((response) => {
        tableSuperModulo.ajax.url(`${base_url}/super-modulo/data-table`).load();
        SwallErrorValidate(response);
    }).catch(() => {

    });
}