<?php

namespace App\SocketCliente;

use stdClass;

//hace referencia a nuestro request

class Config
{
    private $client;
    private $data;

    public function __construct($data)
    {
        $this->data = new stdClass();
        $this->data->request = 'SUBSCRIBE';
        $this->data->message = '';
        $this->data->channel = 'erpBackend';

        $this->client = new \WebSocket\Client(env('ROUTE_SOCKET_IO').'/devices', ['headers' => [
            'origin' => 'localhost',
            'token' => 'web',
        ]]);
    }
    public function set_message($inscripcion)
    {
        $this->client->text(json_encode((array) $this->data));
        try {
            $this->data->request = 'PUBLISH';
            $this->data->message = $inscripcion;
            $this->data->channel = 'erpBackend';
            $this->client->text(json_encode((array) $this->data));
            $this->client->close();
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
