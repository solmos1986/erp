$(document).on("click", ".edit", function () {
    $('#modal_usuario .modal-title').text('Editar usuario');
    $('#form_usuario').trigger("reset");
    BtnAddUpdate($('#btn_save'), 'store', 'update');
    const id = $(this).data('id');
    ajax(`${base_url}/rrhh/usuario/${id}`, 'GET', $('#form_usuario').serialize()).then((response) => {
        $('#modal_usuario').modal('show');
        form(response.data)
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

$(document).on("click", ".update", function () {
    const btn = $(this);
    btn.prop('disabled', true);
    const id = $('#idUsuario').val();
    ajax(`${base_url}/rrhh/usuario/${id}`, 'PUT', $('#form_usuario').serialize()).then((response) => {
        btn.prop('disabled', false);
        BtnAddUpdate($('#btn_save'), 'update', 'store')
        $('#modal_usuario').modal('hide');
        SwallSuccess(response.message)
        tableUsuario.ajax.url(
            `${base_url}/rrhh/usuario`,
        ).load();
    }).catch(() => {
        btn.prop('disabled', false)
    });
});

function form(data) {
    $('#form_usuario #idUsuario').val(data.idUsuario);
    $('#form_usuario #nomUsuario').val(data.nomUsuario);
    $('#form_usuario #mailUsuario').val(data.mailUsuario);
    $('#form_usuario #dirUsuario').val(data.dirUsuario);
    $('#form_usuario #docUsuario').val(data.docUsuario);
    $('#form_usuario #telUsuario').val(data.telUsuario);
}