

var socketDispositivo = null

const dispositivoStore = (values) => {
    socket.emit('dispositivo:web', values)
}
const dispositivoGet = () => {
    socket.on('dispositivo:service', (e) => {
        socketDispositivo = e;
    });
}
//inizialize
dispositivoGet();

