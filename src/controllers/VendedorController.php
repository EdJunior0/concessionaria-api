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

  public function vendedorController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->params['cod_vendedor']) {
          $vendedor = new GetVendedor($this->params['cod_vendedor']);
          echo $vendedor->getVendedor();
        } elseif ($this->params['nome']) {
          $vendedor = new GetVendedorByNome($this->params['nome']);
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
        $vendedor = new DeleteVendedor($this->params['cod_vendedor']);
        echo $vendedor->deleteVendedor();
        break;

      default:
        break;
    }
  }
}
