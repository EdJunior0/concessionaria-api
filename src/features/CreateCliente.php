<?php

namespace src\features;

use src\models\Cliente;
use src\repositories\ClienteRepository;

require_once 'vendor/autoload.php';

class CreateCliente
{

  private $cliente;

  public function __construct($cliente)
  {
    $this->cliente = $cliente;
  }

  private function getClienteInstance()
  {
    $cliente = new Cliente();
    $cliente->setCpf($this->cliente['cpf']);
    $cliente->setNome($this->cliente['nome']);
    $cliente->setEndereco($this->cliente['endereco']);
    return $cliente;
  }

  public function createCliente()
  {
    $clienteRepository = new ClienteRepository();

    $cliente = $clienteRepository->create($this->getClienteInstance());

    return json_encode($cliente);
  }
}
