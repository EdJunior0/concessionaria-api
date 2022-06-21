<?php

namespace src\controllers;

use src\features\CreateVeiculo;
use src\features\DeleteVeiculo;
use src\features\GetVeiculo;
use src\features\GetVeiculoByModel;
use src\features\GetVeiculos;
use src\features\UpdateVeiculo;

require_once 'vendor/autoload.php';

class VeiculoController
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

  public function veiculoController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->payload['cod_veiculo']) {
          $veiculo = new GetVeiculo($this->payload['cod_veiculo']);
          echo $veiculo->getVeiculo();
        } elseif ($this->payload['modelo']) {

          $veiculo = new GetVeiculoByModel($this->payload['modelo']);
          echo $veiculo->getVeiculoByModel();
        } else {

          $veiculo = new GetVeiculos();
          echo $veiculo->getVeiculos();
        }
        break;

      case self::POST:
        $veiculo = new CreateVeiculo($this->payload);
        echo $veiculo->createVeiculo();
        break;

      case self::PATCH:
        $veiculo = new UpdateVeiculo($this->payload);
        echo $veiculo->updateVeiculo();
        break;

      case self::DELETE:
        $veiculo = new DeleteVeiculo($this->payload['cod_veiculo']);
        echo $veiculo->deleteVeiculo();
        break;

      default:
        break;
    }
  }
}
