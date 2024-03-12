function SwallSuccess(message) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: message,
    })
}

function SwallErrorValidate(response) {
    console.log(response)
    if (response.status == 1) {
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: response.message,
        })
    } else {
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
}