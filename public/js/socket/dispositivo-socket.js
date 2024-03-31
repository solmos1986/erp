function connect() {
    var ws = new WebSocket(`${socket_url}/devices`, "front-end");
    ws.onopen = function () {
        // subscribe to some channels
        ws.send(JSON.stringify({
            "request": "SUBSCRIBE",
            "message": "",
            "channel": "erpFrontEnd"
        }));
    };

    ws.onmessage = function (e) {
        const data = JSON.parse(e.data)
        console.log(data.message)
        switch (data.message.event) {
            case 'insertInscripcion:show':
                $.toast(data.message.notificacion)
                break;
            case 'insertFoto:show':
                $.toast(data.message.notificacion)
                break;
            default:
                $.toast(data.message.notificacion)
                break;
        }
    };

    ws.onclose = function (e) {
        console.log('reconexion en 1 second.', e.reason);
        setTimeout(function () {
            connect();
        }, 1000);
    };

    ws.onerror = function (err) {
        console.error('Socket encountered error: ', err.message, 'Closing socket');
        ws.close();
    };
}
$(document).ready(function () {
    connect();
})