<?php

namespace src\features;

use src\models\Venda;
use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class UpdateVenda
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

  public function updateVenda()
  {
    $vendaRepository = new VendaRepository();

    $venda = $this->getvendaInstance();

    $vendaFinded = $vendaRepository->findOne($venda->getCodVeiculo(), $venda->getCodVendedor(), $venda->getCpfCliente());
    if (!$vendaFinded['cod_veiculo']) :
      return json_encode(array(
        "message" => "venda not found!"
      ));
    endif;

    if (!$venda->getCodVeiculo()) :
      $venda->setCodVeiculo($vendaFinded['cod_veiculo']);
    endif;

    if (!$venda->getCodVendedor()) :
      $venda->setCodVendedor($vendaFinded['cod_vendedor']);
    endif;

    if (!$venda->getCpfCliente()) :
      $venda->setCpfCliente($vendaFinded['cpf_cliente']);
    endif;

    if (!$venda->getDataVenda()) :
      $venda->setDataVenda($vendaFinded['data_venda']);
    endif;

    $vendaUpdated = $vendaRepository->update($venda);

    return json_encode($vendaUpdated);
  }
}
