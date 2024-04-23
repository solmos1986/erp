const columns = [{
    data: 'idLector',
    name: 'idLector'
},
{
    data: 'nomLector',
    name: 'nomLector'
},
{
    data: 'ipLector',
    name: 'ipLector'
},
{
    data: 'userLector',
    name: 'userLector'
},
{
    data: 'idLector',
    name: 'idLector',
    orderable: false,
    searchable: false,
    render: function (data, type, row, meta) {
        return `<a href="javascript:void(0)"  data-id="${row.idLector}" class="edit fas fa-pencil-alt text-info"></a> &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)"  data-id="${row.idLector}" class="delete far fa-trash-alt text-danger"></a>`;
    }
}];

let tableLectores = dataTable($('.dtLectores'), `${base_url}/configuracion/lectores`, columns);

$(document).on("click", ".nuevo", function () {
    $("#form_lector").trigger("reset");
    $('#ModalLector').modal('show');
    BtnAddSave($('#btn_save'), 'store', 'update');
    $('#ModalLector .modal-title').text('Nuevo lector');
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', false);
    ajax(`${base_url}/configuracion/lector`, 'POST', $('#form_lector').serialize()).then((response) => {
        if (response.status == 1) {
            tableLectores.ajax.url(`${base_url}/configuracion/lectores`).load();
            SwallSuccess(response.message)
            btn.prop('disabled', false);
            $('#ModalLector').modal('hide');
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".edit", function () {
    $("#form_lector").trigger("reset");
    const id = $(this).data('id');
    BtnAddUpdate($('#btn_save'), 'store', 'update')
    ajax(`${base_url}/configuracion/lector/${id}`, 'GET').then((response) => {
        if (response.status == 1) {
            $('#ModalLector .modal-title').text('Editar lector');
            $('#form_lector #idLector').val(response.data.idLector)
            $('#form_lector #ipLector').val(response.data.ipLector)
            $('#form_lector #nomLector').val(response.data.nomLector)
            $('#form_lector #userLector').val(response.data.userLector)
            $('#form_lector #passLector').val(response.data.passLector)
            $('#ModalLector').modal('show');
        } else {

        }
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".update", function () {
    const btn = $(this);
    btn.prop('disabled', false);
    ajax(`${base_url}/configuracion/lector/${$('#idLector').val()}`, 'PUT', $('#form_lector').serialize()).then((response) => {
        if (response.status == 1) {
            SwallSuccess(response.message)
            btn.prop('disabled', false);
            $('#ModalLector').modal('hide');
            tableLectores.ajax.url(`${base_url}/configuracion/lectores`).load();
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
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
    ajax(`${base_url}/configuracion/lector/${id}`, 'DELETE').then((response) => {
        SwallSuccess(response.message)
        tableLectores.ajax.url(`${base_url}/configuracion/lectores`).load();
    });
}
//data password
$("[data-passLector]").on("click", function () {
    "false" == $(this).attr("data-passLector")
        ? ($(this).siblings("input").attr("type", "text"), $(this).attr("data-passLector", "true"), $(this).addClass("show-password"))
        : ($(this).siblings("input").attr("type", "password"), $(this).attr("data-passLector", "false"), $(this).removeClass("show-password"))
});