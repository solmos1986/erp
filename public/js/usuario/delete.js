
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
    ajax(`${base_url}/rrhh/usuario/${id}`, 'DELETE').then((response) => {
        SwallSuccess(response.message)
        tableUsuario.ajax.url(
            `${base_url}/rrhh/usuario`,
        ).load();
    }).catch(() => {

    });
}