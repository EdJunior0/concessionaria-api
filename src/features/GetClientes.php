<?php

namespace src\features;

use src\repositories\ClienteRepository;

require_once 'vendor/autoload.php';

class GetClientes
{

  public function getClientes()
  {
    $clienteRepository = new ClienteRepository();
    return json_encode($clienteRepository->find());
  }
}
