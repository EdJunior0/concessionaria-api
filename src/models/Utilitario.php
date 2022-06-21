<?php

namespace src\models;

require_once 'vendor/autoload.php';

class Utilitario extends GenericVeiculo
{

  private $nr_assentos;

  public function setNrAssentos($nr_assentos)
  {
    $this->nr_assentos = $nr_assentos;
  }

  public function getNrAssentos()
  {
    return $this->nr_assentos;
  }
}
