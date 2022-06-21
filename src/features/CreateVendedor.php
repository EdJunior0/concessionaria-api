<?php

namespace src\features;

use src\models\Vendedor;
use src\repositories\VendedorRepository;

require_once 'vendor/autoload.php';

class CreateVendedor
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

  public function createVendedor()
  {
    $vendedorRepository = new VendedorRepository();

    $vendedorRepository->create($this->getVendedorInstance());

    return json_encode(array(
      "message" => "Vendedor cadastrado com sucesso!"
    ));
  }
}
