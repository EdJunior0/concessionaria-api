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
  private $params;
  const GET = 'get';
  const POST = 'post';
  const PATCH = 'patch';
  const DELETE = 'delete';

  public function __construct($method, $payload, $params)
  {
    $this->method = $method;
    $this->payload = $payload;
    $this->params = $params;
  }

  public function clienteController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->params['cpf']) {
          $liente = new GetCliente($this->params['cpf']);
          echo $liente->getCliente();
        } elseif ($this->params['nome']) {
          $liente = new GetClienteByNome($this->params['nome']);
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
        $liente = new DeleteCliente($this->params['cpf']);
        echo $liente->deleteCliente();
        break;

      default:
        break;
    }
  }
}
