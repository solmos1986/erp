<?php

namespace App\SocketCliente;
use Illuminate\Validation\ValidationException;
use ElephantIO\Client;

//hace referencia a nuestro request

class Config
{
    private $client;
    private $message;

    public function __construct($message)
    {
        $this->client = new \WebSocket\Client("ws://localhost:3000/devices",[ 'headers' => [
            'origin' => 'localhost',
            'token' => 'web'
        ]]);
    }
    public function set_message($inscripcion)
    {
        try {
            $this->client->text(json_encode((array) $inscripcion));
          /*   if ($this->client->receive()) {
                dd('Error no se envio atraves del socket verifique la conexion');
            }; */
            $this->client->close();
        } catch (\Throwable $th) {
            dd($th);
        }

    }
}
