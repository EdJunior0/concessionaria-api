<?php

namespace src\features;

use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class GetVendas
{

  public function getVendas()
  {
    $vendaRepository = new VendaRepository();
    return json_encode($vendaRepository->find());
  }
}
