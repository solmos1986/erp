$(document).on("click", ".nuevo", function () {
    $('#modal_usuario').modal('show');
    $('#modal_usuario .modal-title').text('Nuevo usuario');
    $('#form_usuario').trigger("reset");
    BtnAddUpdate($('#btn_save'), 'update', 'store')
});

$(document).on("click", ".store", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    ajax(`${base_url}/rrhh/usuario`, 'POST', $('#form_usuario').serialize()).then((response) => {
        btn.prop('disabled', false);
        BtnAddUpdate($('#btn_save'), 'store', 'update')
        $('#modal_usuario').modal('hide');
        SwallSuccess(response.message)
        tableUsuario.ajax.url(
            `${base_url}/rrhh/usuario`,
        ).load();
    }).catch(() => {
        btn.prop('disabled', false)
    });
});