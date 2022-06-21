<?php

namespace src\features;

use src\repositories\VendedorRepository;

require_once 'vendor/autoload.php';

class DeleteVendedor
{

  private $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function deleteVendedor()
  {
    $vendedorRepository = new VendedorRepository();

    $vendedor = $vendedorRepository->findOne($this->id);
    if (!$vendedor['cod_vendedor']) :
      return json_encode(array(
        "message" => "vendedor not found"
      ));
    endif;

    $vendedorRepository->delete($this->id);

    return json_encode(array(
      "message" => "vendedor deleted"
    ));
  }
}
