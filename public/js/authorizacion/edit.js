
$(document).on("click", ".editar", function () {
  const btn = $(this);
  const id = $(this).data('id');
  btn.prop('disabled', true);

  $('#modal_authorizacion .modal-title').text('Editar Authenticacion');

  $('#form_autorizacion').trigger("reset");

  ajax(`${base_url}/authorizacion/${id}`, 'GET').then((response) => {
    btn.prop('disabled', false);
    BtnAddUpdate($('#btn_save'), 'store', 'update')
    $('#modal_authorizacion').modal('show');
    form(response.data);
    addOptionsSelect2(response.data.roles)
  }).catch(() => {
    btn.prop('disabled', false)
  });
});

function form(data) {
  $('#form_autorizacion #nomUsuario').text(data.nomUsuario);
  $('#form_autorizacion #mailUsuario').text(data.mailUsuario);
  $('#form_autorizacion #dirUsuario').text(data.dirUsuario);
  $('#form_autorizacion #docUsuario').text(data.docUsuario);
  $('#form_autorizacion #telUsuario').text(data.telUsuario);
  $('#form_autorizacion #authenticacion_id').val(data.authenticacion_id);
  $('#form_autorizacion #usuario').val(data.usuario);
  $('#form_autorizacion #contraseña').val(data.contraseña);
}

function addOptionsSelect2(roles) {
  var options = []
  roles.map((rol) => {
    options.push(rol.rol_id)
  });
  $('#roles').val(options).trigger('change');
}

$('#roles').select2();

$("[data-password]").on("click", function () {
  "false" == $(this).attr("data-password") ? ($(this).siblings("input").attr("type", "text"),
    $(this).attr("data-password", "true"),
    $(this).addClass("show-password")) : ($(this).siblings("input").attr("type", "password"),
      $(this).attr("data-password", "false"),
      $(this).removeClass("show-password"))
});

$(document).on("click", ".update", function () {
  const btn = $(this);
  const id = $('#authenticacion_id').val();
  console.log($('#roles').val())
  ajax(`${base_url}/authorizacion/${id}`, 'PUT', $('#form_autorizacion').serialize()).then((response) => {
    btn.prop('disabled', false);
    $('#modal_authorizacion').modal('hide');
    SwallSuccess(response.message)
  }).catch(() => {
    btn.prop('disabled', false)
  });
});