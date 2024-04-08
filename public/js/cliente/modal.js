const columns = [{
    data: 'idCliente',
    name: 'idCliente'
},
{
    data: 'nomCliente',
    name: 'nomCliente'
},
{
    data: 'tel1Cliente',
    name: 'tel1Cliente'
},
{
    data: 'dirCliente',
    name: 'dirCliente'
},
{
    data: 'docCliente',
    name: 'docCliente'
},
{
    data: 'mailCliente',
    name: 'mailCliente'
},
{
    data: 'idCliente',
    name: 'idCliente',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<i data-id="${row.idCliente}" class="edit fas fa-pencil-alt text-info m-1 cursor-pointer" title="Editar"></i>
        <i data-id="${row.idCliente}" class="delete far fa-trash-alt text-danger m-1 cursor-pointer" title="Eliminar"></i>`;
    }
},
];

let tableCliente = dataTable($('.data-table-cliente'), `${base_url}/comercial/cliente/data-table`, columns);

$(document).on("click", ".nuevo", function () {
    $("#form_client").trigger("reset");
    $('#modal_cliente').modal('show');
    //preview
    $('#foto_tomada').prop('src', `${base_url}/assets/perfil/peril.webp`);
    $(".subir_foto").trigger("click");
    $('#modal_cliente .modal-title').text('Nuevo cliente');

    BtnAddSave($('#btn_save'), 'store', 'update')
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    ajax(`${base_url}/comercial/cliente`, 'POST', $('#form_client').serialize()).then((response) => {
        if (response.status == '1') {
            $('#modal_cliente').modal('hide');
            tableCliente.ajax.url(`${base_url}/comercial/cliente/data-table`).load();
            btn.prop('disabled', false);
            SwallSuccess(response.message)
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
});


$(document).on("click", ".edit", function () {
    $("#form_client").trigger("reset");
    const idCliente = $(this).data('id');
    $('#modal_cliente .modal-title').text('Editar cliente');
    BtnAddUpdate($('#btn_save'), 'store', 'update')
    ajax(`${base_url}/comercial/cliente/${idCliente}`, 'GET').then((response) => {
        if (response.status == '1') {
            //preview
            $('#foto_tomada').prop('src', response.data.fotoCliente)
            $('#image').val(response.data.fotoCliente)
            $(".subir_foto").trigger("click");
            //set data
            $('#form_client #idCliente').val(response.data.idCliente);
            $('#form_client #nomCliente').val(response.data.nomCliente);
            $('#form_client #docCliente').val(response.data.docCliente);
            $('#form_client #tel1Cliente').val(response.data.tel1Cliente);
            $('#form_client #tel2Cliente').val(response.data.tel2Cliente);
            $('#form_client #mailCliente').val(response.data.mailCliente);
            $('#form_client #dirCliente').val(response.data.dirCliente);
            $('#form_client #image').val(response.data.fotoCliente);

            $('#modal_cliente').modal('show');
        } else {

        }
    })
});

$(document).on("click", ".update", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    ajax(`${base_url}/comercial/cliente/${$('#idCliente').val()}`, 'PUT', $('#form_client').serialize()).then((response) => {
        if (response.status == '1') {
            $('#modal_cliente').modal('hide');
            tableCliente.ajax.url(`${base_url}/comercial/cliente/data-table`).load();
            btn.prop('disabled', false);
            SwallSuccess(response.message)
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
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
    ajax(`${base_url}/comercial/cliente/${id}`, 'DELETE').then((response) => {
        SwallSuccess(response.message)
        tableCliente.ajax.url(`${base_url}/comercial/cliente/data-table`).load();
    }).catch(() => {

    });
} 