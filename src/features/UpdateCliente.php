<?php

namespace src\features;

use src\models\Cliente;
use src\repositories\ClienteRepository;

require_once 'vendor/autoload.php';

class UpdateCliente
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

  public function updateCliente()
  {
    $clienteRepository = new ClienteRepository();

    $cliente = $this->getClienteInstance();

    $clienteFinded = $clienteRepository->findOne($cliente->getCpf());
    if (!$clienteFinded['cpf']) :
      return json_encode(array(
        "message" => "cliente not found!"
      ));
    endif;

    if (!$cliente->getNome()) :
      $cliente->setNome($clienteFinded['nome']);
    endif;

    if (!$cliente->getEndereco()) :
      $cliente->setEndereco($clienteFinded['endereco']);
    endif;

    $clienteRepository->update($cliente);

    return json_encode(array(
      "message" => "cliente updated"
    ));
  }
}
