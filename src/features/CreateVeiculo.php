<?php

namespace src\features;

use src\models\Caminhao;
use src\models\Carro;
use src\models\Utilitario;
use src\models\Veiculo;
use src\repositories\CaminhaoRepository;
use src\repositories\CarroRepository;
use src\repositories\UtilitarioRepository;
use src\repositories\VeiculoRepository;

require_once 'vendor/autoload.php';

class CreateVeiculo
{

  private $veiculo;

  public function __construct($veiculo)
  {
    $this->veiculo = $veiculo;
  }

  private function getVeiculoInstance()
  {
    $veiculo = new Veiculo($this->veiculo['cod_veiculo']);
    $veiculo->setPreco($this->veiculo['preco']);
    $veiculo->setModelo($this->veiculo['modelo']);
    $veiculo->setCarType($this->veiculo['car_type']);
    return $veiculo;
  }

  private function getCarroInstance()
  {
    $carro = new Carro($this->veiculo['cod_veiculo']);
    $carro->setTamanhoMotor($this->veiculo['tamanho_motor']);
    return $carro;
  }

  private function getCaminhaoInstance()
  {
    $caminhao = new Caminhao($this->veiculo['cod_veiculo']);
    $caminhao->setCapacidadePeso($this->veiculo['capacidade_peso']);
    return $caminhao;
  }

  private function getUtilitarioInstance()
  {
    $utilitario = new Utilitario($this->veiculo['cod_veiculo']);
    $utilitario->setNrAssentos($this->veiculo['nr_assentos']);
    return $utilitario;
  }

  public function createVeiculo()
  {
    $veiculoRepository = new VeiculoRepository();
    $carroRepository = new CarroRepository();
    $caminhaoRepository = new CaminhaoRepository();
    $utilitarioRepository = new UtilitarioRepository();

    $veiculo = $veiculoRepository->create($this->getVeiculoInstance());

    if ($this->veiculo['car_type'] == "carro") :
      $carroRepository->create($this->getCarroInstance());
    endif;

    if ($this->veiculo['car_type'] == "caminhao") :
      $caminhaoRepository->create($this->getCaminhaoInstance());
    endif;

    if ($this->veiculo['car_type'] == "utilitario") :
      $utilitarioRepository->create($this->getUtilitarioInstance());
    endif;

    return json_encode(array(
      "message" => "Veículo cadastrado com sucesso!"
    ));
  }
}
