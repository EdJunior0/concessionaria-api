<?php

namespace src\models;

require_once 'vendor/autoload.php';

class Caminhao extends GenericVeiculo
{

  private $capacidade_peso;

  public function setCapacidadePeso($capacidade_peso)
  {
    $this->capacidade_peso = $capacidade_peso;
  }

  public function getCapacidadePeso()
  {
    return $this->capacidade_peso;
  }
}
