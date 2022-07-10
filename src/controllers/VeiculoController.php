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

  public function veiculoController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->params['cod_veiculo']) {
          $veiculo = new GetVeiculo($this->params['cod_veiculo']);
          echo $veiculo->getVeiculo();
        } elseif ($this->params['modelo']) {

          $veiculo = new GetVeiculoByModel($this->params['modelo']);
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
        $veiculo = new DeleteVeiculo($this->params['cod_veiculo']);
        echo $veiculo->deleteVeiculo();
        break;

      default:
        break;
    }
  }
}
