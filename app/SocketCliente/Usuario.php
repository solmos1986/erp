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
        $this->config->emit = "usuario";
        $this->config->data = null;
        $this->socket = new Config($this->config);
    }
    public function store_cliente($data)
    {
        $this->config->data = $data;
        $this->config->channel = "store";
        $this->socket->set_message($this->config);
    }
    public function update_cliente($inscripcion)
    {
        $this->config->data = $data;
        $this->config->channel = "update";
        $this->socket->set_message($this->config);
    }
    public function delete_cliente($inscripcion)
    {
        $this->config->data = $data;
        $this->config->channel = "delete";
        $this->socket->set_message($this->config);
    }
}
