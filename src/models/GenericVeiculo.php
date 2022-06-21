<?php

namespace src\models;

require_once 'vendor/autoload.php';

class GenericVeiculo
{

  private $cod_veiculo;

  public function __construct($cod_veiculo)
  {
    $this->cod_veiculo = $cod_veiculo;
  }

  public function setCodVeiculo($id)
  {
    $this->cod_veiculo = $id;
  }

  public function getCodVeiculo()
  {
    return $this->cod_veiculo;
  }
}
