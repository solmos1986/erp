<?php

namespace App\SocketCliente;

use Illuminate\Support\Facades\Log;
use stdClass;

//hace referencia a nuestro request

class Config
{
    private $client;
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function subscribe_usuario($data)
    {
        $this->data = new stdClass();
        $this->data->request = 'SUBSCRIBE';
        $this->data->message = '';
        $this->data->channel = 'web';

        $this->client = new \WebSocket\Client(env('ROUTE_SOCKET_IO') . '/devices', ['headers' => [
            'origin' => 'localhost',
            'token' => 'web',
        ]]);
        Log::info("Config() socket conexion => " . json_encode($this->data, JSON_PRETTY_PRINT));
        $this->client->text(json_encode((array) $this->data));
    }

    public function subscribe_server($data)
    {
        $this->data = new stdClass();
        $this->data->request = 'SUBSCRIBE';
        $this->data->message = '';
        $this->data->channel = 'server';

        $this->client = new \WebSocket\Client(env('ROUTE_SOCKET_IO') . '/devices', ['headers' => [
            'origin' => 'localhost',
            'token' => 'web',
        ]]);
        Log::info("Config/subscribe_server() estableciendo socket conexion => " . json_encode($this->data, JSON_PRETTY_PRINT));
        $this->client->text(json_encode((array) $this->data));
    }

    public function set_message($inscripcion)
    {
        $this->subscribe_usuario($this->data);
        try {
            $this->data->request = 'PUBLISH';
            $this->data->message = $inscripcion;
            $this->data->channel = 'web'; // auth()->user()->obtener_usuario()->authenticacion_id
            $this->client->text(json_encode((array) $this->data));
            Log::info('Config/set_message() set_message enviando mensaje canal:' . $this->data->channel . ' socket => ' . json_encode($this->data, JSON_PRETTY_PRINT));
            $this->client->close();
        } catch (\Throwable $th) {
            dd($th);
            Log::critical('Config/set_message() enviando mensaje canal:' . $this->data->channel . ' socket => ' . $th->getMessage());
        }
    }
    public function set_mesage_interno($inscripcion)
    {
        $this->subscribe_server($this->data);
        try {
            $this->data->request = 'PUBLISH';
            $this->data->message = $inscripcion;
            $this->data->channel = 'server';
            $this->client->text(json_encode((array) $this->data));
            Log::info('Config/set_mesage_interno() enviando mensaje canal:' . $this->data->channel . ' socket  => ' . json_encode($this->data, JSON_PRETTY_PRINT));
            $this->client->close();
        } catch (\Throwable $th) {
            Log::critical('Config/set_mesage_interno() enviando mensaje canal:' . $this->data->channel . ' socket => ' . $th->getMessage());
        }
    }
}
