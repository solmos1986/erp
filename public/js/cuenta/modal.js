
$(document).on("click", ".sub_cuenta", function () {
    $("#form_cuenta").trigger("reset");
    const idCuenta = $(this).data('id');
    $('#modal_cuenta .modal-title').text('Añadir cuenta al grupo');
    BtnAddUpdate($('#btn_save'), 'update', 'store');
    ajax(`${base_url}/cuenta/create/${idCuenta}`, 'GET').then((response) => {
        if (response.status == '1') {
            $('#modal_cuenta .modal-title').text(`Añadir cuenta al grupo ${response.data.nombre_cuenta}`);
            $("#form_cuenta #codigo_cuenta").val(response.data.nuevo_codigo)
            $("#form_cuenta #orden_cuenta_id").val(response.data.orden_cuenta_id)
            $("#form_cuenta #cuenta_id").val(response.data.cuenta_id)
            $('#modal_cuenta').modal('show');
        } else {
            SwallErrorValidate(response);
        }
    })
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    ajax(`${base_url}/cuenta/store`, 'POST', $('#form_cuenta').serialize()).then((response) => {
        if (response.status == '1') {
            $('#modal_cuenta').modal('hide');
            tableCuenta.ajax.url(`${base_url}/cuenta/data-table`).load();
            btn.prop('disabled', false);
            SwallSuccess(response.message)
        } else {
            SwallErrorValidate(response);
            btn.prop('disabled', false);
        }
    })
});