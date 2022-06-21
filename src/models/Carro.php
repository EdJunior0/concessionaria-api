<?php

namespace src\models;

require_once 'vendor/autoload.php';

class Carro extends GenericVeiculo
{

  private $tamanho_motor;

  public function setTamanhoMotor($tamanho_motor)
  {
    $this->tamanho_motor = $tamanho_motor;
  }

  public function getTamanhoMotor()
  {
    return $this->tamanho_motor;
  }
}
