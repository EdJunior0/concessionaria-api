<?php

namespace src\features;

use src\repositories\VendaRepository;

require_once 'vendor/autoload.php';

class GetVendaByData
{

  private $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function getVendaByData()
  {
    $vendaRepository = new VendaRepository();

    $venda = $vendaRepository->findOneByData($this->data);

    if ($venda['cpf']) :
      return json_encode($venda);
    else :
      return json_encode(array(
        "message" => "venda not found!"
      ));
    endif;
  }
}
