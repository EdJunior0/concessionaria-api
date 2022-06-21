<?php

namespace src\features;

use src\repositories\VendedorRepository;

require_once 'vendor/autoload.php';

class GetVendedores {

  public function getVendedores() {
    $vendedorRepository = new VendedorRepository();
    return json_encode($vendedorRepository->find());
  }

}