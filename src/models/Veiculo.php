<?php

namespace src\models;

require_once 'vendor/autoload.php';

class Veiculo extends GenericVeiculo
{
  private $preco, $modelo, $car_type;

  public function getPreco()
  {
    return $this->preco;
  }

  public function setPreco($preco)
  {
    $this->preco = $preco;
  }

  public function getModelo()
  {
    return $this->modelo;
  }

  public function setModelo($modelo)
  {
    $this->modelo = $modelo;
  }

  public function getCarType()
  {
    return $this->car_type;
  }

  public function setCarType($car_type)
  {
    $this->car_type = $car_type;
  }
}
