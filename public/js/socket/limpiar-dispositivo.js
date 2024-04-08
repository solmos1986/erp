function limpiarAutomatico(data) {
    switch (data.message.event) {
        case 'delete:show':
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