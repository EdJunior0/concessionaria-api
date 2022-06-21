<?php

namespace src\features;

use src\models\Venda;
use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class CreateVenda
{

  private $venda;

  public function __construct($venda)
  {
    $this->venda = $venda;
  }

  private function getVendaInstance()
  {
    $venda = new Venda();
    $venda->setCodVeiculo($this->venda['cod_veiculo']);
    $venda->setCodVendedor($this->venda['cod_vendedor']);
    $venda->setCpfCliente($this->venda['cpf_cliente']);
    $venda->setDataVenda($this->venda['data_venda']);

    return $venda;
  }

  public function createVenda()
  {
    $vendaRepository = new VendaRepository();

    $vendaRepository->create($this->getVendaInstance());

    return json_encode(array(
      "message" => "venda cadastrado com sucesso!"
    ));
  }
}
