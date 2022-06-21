<?php

namespace src\features;

use src\repositories\VendedorRepository;

require_once 'vendor/autoload.php';

class GetVendedorByNome
{

  private $name;

  public function __construct($name)
  {
    $this->name = $name;
  }

  public function getVendedorByNome()
  {
    $vendedorRepository = new VendedorRepository();

    $vendedor = $vendedorRepository->findOneByName($this->name);

    if ($vendedor['cod_vendedor']) :
      return json_encode($vendedor);
    else :
      return json_encode(array(
        "message" => "vendedor not found!"
      ));
    endif;
  }
}
