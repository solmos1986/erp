function error_status(jqXHR) {
    switch (jqXHR.status) {
        case 419:
            Swal.fire({
                icon: 'error',
                title: 'Expiro la session',
                html: 'Por favor recarge la pagina'
            });
            break;
        case 401:
            Swal.fire({
                icon: 'error',
                title: 'No autorizado',
                html: 'Por favor recarge la pagina'
            });
            break;
        default:
            Swal.fire({
                icon: 'error',
                title: 'a ocurrido un error en el server',
                html: 'error',
            });
            break;
    }
}
function fail() {
    Swal.fire({
        icon: 'error',
        title: 'a ocurrido un inesperado',
        html: '',
    });
}