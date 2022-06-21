<?php

namespace src\features;

use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class DeleteVenda
{

  private $venda;

  public function __construct($venda)
  {
    $this->venda = $venda;
  }

  public function deleteVenda()
  {
    $vendaRepository = new VendaRepository();

    $venda = $vendaRepository->findOne($this->venda['cod_veiculo'], $this->venda['cod_vendedor'], $this->venda['cpf_cliente']);
    if (!$venda['cod_veiculo']) :
      return json_encode(array(
        "message" => "venda not found"
      ));
    endif;

    $vendaRepository->delete($this->venda['cod_veiculo'], $this->venda['cod_vendedor'], $this->venda['cpf_cliente']);

    return json_encode(array(
      "message" => "venda deleted"
    ));
  }
}
