<?php

namespace src\controllers;

use src\features\CreateVenda;
use src\features\DeleteVenda;
use src\features\GetVenda;
use src\features\GetVendaByData;
use src\features\GetVendas;
use src\features\UpdateVenda;

require_once 'vendor/autoload.php';

class VendaController
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

  public function vendaController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->params['cod_veiculo'] || $this->params['cod_vendedor'] || $this->params['cpf_cliente']) {
          $venda = new GetVenda($this->params);
          echo $venda->getvenda();
        } elseif ($this->params['data_venda']) {
          $venda = new GetVendaByData($this->params['data_venda']);
          echo $venda->getVendaByData();
        } else {
          $venda = new GetVendas();
          echo $venda->getVendas();
        }
        break;

      case self::POST:
        $venda = new CreateVenda($this->payload);
        echo $venda->createVenda();
        break;

      case self::PATCH:
        $venda = new UpdateVenda($this->payload);
        echo $venda->updateVenda();
        break;

      case self::DELETE:
        $venda = new DeleteVenda($this->params);
        echo $venda->deleteVenda();
        break;

      default:
        break;
    }
  }
}
