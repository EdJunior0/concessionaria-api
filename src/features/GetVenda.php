<?php

namespace src\features;

use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class GetVenda
{

  private $venda;

  public function __construct($venda)
  {
    $this->venda = $venda;
  }

  public function getVenda()
  {
    $vendaRepository = new VendaRepository();

    $venda = $vendaRepository->findOne($this->venda['cod_veiculo'], $this->venda['cod_vendedor'], $this->venda['cpf_cliente']);

    if ($venda['cod_veiculo']) :
      return json_encode($venda);
    else :
      return json_encode(array(
        "message" => "venda not found!"
      ));
    endif;
  }
}
