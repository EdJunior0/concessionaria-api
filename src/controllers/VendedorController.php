<?php

namespace src\controllers;

use src\features\CreateVendedor;
use src\features\DeleteVendedor;
use src\features\GetVendedor;
use src\features\GetVendedorByNome;
use src\features\GetVendedores;
use src\features\UpdateVendedor;

require_once 'vendor/autoload.php';

class VendedorController
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

  public function vendedorController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->payload['cod_vendedor']) {
          $vendedor = new GetVendedor($this->payload['cod_vendedor']);
          echo $vendedor->getVendedor();
        } elseif ($this->payload['nome']) {

          $vendedor = new GetVendedorByNome($this->payload['nome']);
          echo $vendedor->getVendedorByNome();
        } else {

          $vendedor = new GetVendedores();
          echo $vendedor->getVendedores();
        }
        break;

      case self::POST:
        $vendedor = new CreateVendedor($this->payload);
        echo $vendedor->createVendedor();
        break;

      case self::PATCH:
        $vendedor = new UpdateVendedor($this->payload);
        echo $vendedor->updatevendedor();
        break;

      case self::DELETE:
        $vendedor = new DeleteVendedor($this->payload['cod_vendedor']);
        echo $vendedor->deleteVendedor();
        break;

      default:
        break;
    }
  }
}
