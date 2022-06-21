<?php

namespace src\features;

use src\repositories\ClienteRepository;

require_once 'vendor/autoload.php';

class GetClienteByNome
{

  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function getClienteByNome()
  {
    $clienteRepository = new ClienteRepository();

    $cliente = $clienteRepository->findOneByName($this->name);

    if ($cliente['cpf']) :
      return json_encode($cliente);
    else :
      return json_encode(array(
        "message" => "cliente not found!"
      ));
    endif;
  }
}
