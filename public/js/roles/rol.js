


const columns = [{
    data: 'nombre_rol',
    name: 'nombre_rol'
},
{
    data: 'super_modulos',
    name: 'super_modulos',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        let chips = ``;
        row.super_modulos.map((super_modulo) => {
            chips += `<div class="badge bg-secondary text-light mb-0 m-1">${super_modulo.nombre_super_modulo}</div>`
        })
        return chips;
    }
},
{
    data: 'rol_id',
    name: 'rol_id',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `
            <i data-id="${row.rol_id}" class="editar fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
            <i data-id="${row.rol_id}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>
        `;
    }
}];

let tableRoles = dataTable($('.data-table-roles'), `${base_url}/roles/data-table`, columns);

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
    const values = {
        "idLector": 0,
        "create_time": "Date",
        "nomLector": "string",
        "ipLector": "192.168.1.247",
        "portLector": 0,
        "userLector": "admin",
        "passLector": "molomix654",
        "condicionLector": 0
    }
    dispositivoStore(values)

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
        console.log('modelo', socketDispositivo)
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
            tableRoles.ajax.url(`${base_url}/roles/data-table`).load();
        } else {
            console.log('error', response)
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
            tableRoles.ajax.url(`${base_url}/roles/data-table`).load();
        } else {
            SwallErrorValidate(response)
        }
        btn.prop('disabled', false);
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".editar", function () {
    data = initial;
    const btn = $(this);
    console.log('editar')
    const id = $(this).data('id');
    btn.prop('disabled', true);
    $('#modal_rol .modal-title').text('Editar rol');
    ajax(`${base_url}/roles/${id}`, 'GET').then((response) => {
        btn.prop('disabled', false);
        data = response.data;
        renderSuperModulos();
        BtnAddUpdate($('#btn_save'), 'store', 'update')
        $('#modal_rol').modal('show');
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
        tableRoles.ajax.url(`${base_url}/roles/data-table`).load();
    }).catch(() => {

    });
}