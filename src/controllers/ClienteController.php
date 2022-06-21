<?php

namespace src\controllers;

use src\features\CreateCliente;
use src\features\DeleteCliente;
use src\features\GetCliente;
use src\features\GetClienteByNome;
use src\features\GetClientes;
use src\features\UpdateCliente;

require_once 'vendor/autoload.php';

class ClienteController
{

  private $method;
  private $payload;
  const GET = 'get';
  const POST = 'post';
  const PATCH = 'patch';
  const DELETE = 'delete';

  public function __construct($method, $payload)
  {
    $this->method = $method;
    $this->payload = $payload;
  }

  public function clienteController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->payload['cpf']) {
          $liente = new GetCliente($this->payload['cpf']);
          echo $liente->getCliente();
        } elseif ($this->payload['nome']) {

          $liente = new GetClienteByNome($this->payload['nome']);
          echo $liente->getClienteByNome();
        } else {

          $liente = new GetClientes();
          echo $liente->getClientes();
        }
        break;

      case self::POST:
        $liente = new CreateCliente($this->payload);
        echo $liente->createCliente();
        break;

      case self::PATCH:
        $liente = new UpdateCliente($this->payload);
        echo $liente->updateCliente();
        break;

      case self::DELETE:
        $liente = new DeleteCliente($this->payload['cpf']);
        echo $liente->deleteCliente();
        break;

      default:
        break;
    }
  }
}
