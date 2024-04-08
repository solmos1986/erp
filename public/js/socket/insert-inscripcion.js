function insertInscripcion(data) {
    switch (data.message.event) {
        case 'insertInscripcion:show':
            $.toast(data.message.notificacion)
            break;
        case 'insertFoto:show':
            $.toast(data.message.notificacion)
            break;
        default:
            //$.toast(data.message.notificacion)
            break;
    }
}