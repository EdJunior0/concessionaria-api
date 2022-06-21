<?php

namespace src\features;

require_once 'vendor/autoload.php';

use src\repositories\VeiculoRepository;

class GetVeiculos {

  public function getVeiculos() {
    $veiculoRepository = new VeiculoRepository();
    return json_encode($veiculoRepository->find());
  }

}