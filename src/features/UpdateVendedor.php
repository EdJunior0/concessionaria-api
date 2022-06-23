<?php

namespace src\features;

use src\models\Vendedor;
use src\repositories\VendedorRepository;

require_once 'vendor/autoload.php';

class UpdateVendedor
{

  private $vendedor;

  public function __construct($vendedor)
  {
    $this->vendedor = $vendedor;
  }

  private function getVendedorInstance()
  {
    $vendedor = new Vendedor();
    $vendedor->setCodVendedor($this->vendedor['cod_vendedor']);
    $vendedor->setNome($this->vendedor['nome']);
    return $vendedor;
  }

  public function updatevendedor()
  {
    $vendedorRepository = new VendedorRepository();

    $vendedor = $this->getVendedorInstance();

    $vendedorFinded = $vendedorRepository->findOne($vendedor->getCodVendedor());
    if (!$vendedorFinded['cod_vendedor']) :
      return json_encode(array(
        "message" => "vendedor not found!"
      ));
    endif;

    if (!$vendedor->getNome()) :
      $vendedor->setNome($vendedorFinded['nome']);
    endif;

    $vendedorUpdated = $vendedorRepository->update($vendedor);

    return json_encode($vendedorUpdated);
  }
}
