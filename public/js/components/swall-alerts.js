function SwallSuccess(message) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
    })
}

function SwallErrorValidate(response) {
    $alert = "";
    response.message.forEach(function (error) {
        $alert += `* ${error}<br>`;
    });
    Swal.fire({
        icon: 'error',
        title: 'Complete los siguente campos:',
        html: $alert,
    })
}