<?php

namespace App\SocketIo;

use ElephantIO\Client;

//hace referencia a nuestro request

class SocketCliente
{
    public $client;
    public function __construct()
    {
        $url = env('ROUTE_SOCKET_IO');
        $options = ['client' => Client::CLIENT_4X];
        $this->client = Client::create($url, $options);
        $this->client->connect();
    }
    public function store_cliente($inscripcion)
    {
        $this->client->emit('store:usuario:web', $inscripcion);
    }
    public function update_cliente($inscripcion)
    {
        $this->client->emit('update:usuario:web', $inscripcion);
    }
    public function delete_cliente($inscripcion)
    {
        $this->client->emit('delete:usuario:web', $inscripcion);
    }
}
