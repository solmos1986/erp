
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
            <i data-id="${row.authenticacion_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

let tableUsusario = dataTable($('.data-table-usuario'), `${base_url}/authorizacion/data-table`, columns);

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

/* 
const initial = {
    rol_id: 0,
    nombre_rol: '',
    super_modulos: []
}
var data = {
    rol_id: 0,
    nombre_rol: '',
    super_modulos: []
}

$(document).on("click", ".nuevo", function () {
    data = initial;
    const btn = $(this);
    btn.prop('disabled', true);
    $('#modal_rol .modal-title').text('Nuevo rol');
    ajax(`${base_url}/roles/create`, 'GET').then((response) => {
        btn.prop('disabled', false);
        data = response.data;
        renderSuperModulos();
        BtnAddSave($('#btn_save'), 'store', 'update')
        $('#modal_rol').modal('show');
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    data.rol_id = $('#form_rol #rol_id').val();
    data.nombre_rol = $('#form_rol #nombre_rol').val();
    ajax(`${base_url}/roles/store`, 'POST', data).then((response) => {
        if (response.status == 1) {
            $('#modal_rol').modal('hide');
            SwallSuccess(response.message)
            tableUsusario.ajax.url(`${base_url}/roles/data-table`).load();
        } else {
            console.log('error',response)
            SwallErrorValidate(response)
        }
        btn.prop('disabled', false);
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".update", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    data.rol_id = $('#form_rol #rol_id').val();
    data.nombre_rol = $('#form_rol #nombre_rol').val();
    ajax(`${base_url}/roles/${data.rol_id}`, 'PUT', data).then((response) => {
        if (response.status == 1) {
            $('#modal_rol').modal('hide');
            SwallSuccess(response.message)
            tableUsusario.ajax.url(`${base_url}/roles/data-table`).load();
        } else {
            SwallErrorValidate(response)
        }
        btn.prop('disabled', false);
    }).catch(() => {
        btn.prop('disabled', false)
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
    ajax(`${base_url}/roles/${id}`, 'DELETE').then((response) => {
        SwallSuccess(response.message)
        tableUsusario.ajax.url(`${base_url}/roles/data-table`).load();
    }).catch(() => {

    });
} */