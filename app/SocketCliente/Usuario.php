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
        $this->config->data = $data;
        $this->config->type = "store:init";
        $this->config->channel = "web";
        $this->socket->set_message($this->config);
    }
    public function update_cliente($inscripcion)
    {
        $this->config->data = $data;
        $this->config->type = "edit:init";
        $this->config->channel = "web";
        $this->socket->set_message($this->config);
    }
    public function delete_cliente($inscripcion)
    {
        $this->config->data = $data;
        $this->config->type = "destroy:init";
        $this->config->channel = "web";
        $this->socket->set_message($this->config);
    }
}
