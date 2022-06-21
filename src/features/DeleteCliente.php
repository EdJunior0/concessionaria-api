<?php

namespace src\features;

use src\repositories\ClienteRepository;

require_once 'vendor/autoload.php';

class DeleteCliente
{

  private $cpf;

  public function __construct($cpf)
  {
    $this->cpf = $cpf;
  }

  public function deleteCliente()
  {
    $clienteRepository = new ClienteRepository();

    $cliente = $clienteRepository->findOne($this->cpf);
    if (!$cliente['cpf']) :
      return json_encode(array(
        "message" => "cliente not found"
      ));
    endif;

    $clienteRepository->delete($this->cpf);

    return json_encode(array(
      "message" => "cliente deleted"
    ));
  }
}
