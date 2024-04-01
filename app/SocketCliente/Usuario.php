<?php

namespace App\SocketCliente;

use App\SocketCliente;
use stdClass;

//hace referencia a nuestro request

class Usuario
{
    public $config;
    public $socket;
    public function __construct()
    {
        $this->config = new stdClass();
        $this->config->event = "usuario";
        $this->config->data = null;
        $this->socket = new Config($this->config);
    }
    public function store_cliente($data)
    {
        $message = new stdClass();
        $message->event = 'insertInscripcion:init';
        $message->req = [];
        $message->res = [];
        $message->data = $data;
        $this->socket->set_message($message);
    }
    public function eliminar_clientes_automatico($data)
    {
        $message = new stdClass();
        $message->event = 'deleteAutomatico:init';
        $message->req = [];
        $message->res = [];
        $message->data = $data;
        $this->socket->set_message($message);
    }
}