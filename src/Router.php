<?php

namespace src;

use src\controllers\ClienteController;
use src\controllers\UserController;
use src\controllers\VeiculoController;
use src\controllers\VendaController;
use src\controllers\VendedorController;

require_once 'vendor/autoload.php';

class Router
{

  private $url;
  private $payload;
  private $method;
  const VEICULO = 'veiculo';
  const CLIENTE = 'cliente';
  const VENDEDOR = 'vendedor';
  const VENDA = 'venda';
  const USER = 'user';

  public function __construct($url, $payload, $method)
  {
    $this->url = $url;
    $this->payload = $payload;
    $this->method = strtolower($method);
  }

  private function routes()
  {

    $veiculoController = new VeiculoController($this->method, $this->payload);
    $vendedorController = new VendedorController($this->method, $this->payload);
    $clienteController = new ClienteController($this->method, $this->payload);
    $vendaController = new VendaController($this->method, $this->payload);
    $userController = new UserController($this->method, $this->payload);


    switch ($this->url) {
      case self::VEICULO:
        $veiculoController->veiculoController();
        break;

      case self::CLIENTE:
        $clienteController->clienteController();
        break;

      case self::VENDEDOR:
        $vendedorController->vendedorController();
        break;

      case self::VENDA:
        $vendaController->vendaController();
        break;

      case self::USER:
        $userController->userController();
        break;

      default:
        echo json_encode(array(
          "ok" => true
        ));
        break;
    }
  }

  public function start()
  {
    $this->routes();
  }
}
