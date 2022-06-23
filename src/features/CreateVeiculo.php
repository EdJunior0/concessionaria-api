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
    $veiculo = new Veiculo(null);
    $veiculo->setPreco($this->veiculo['preco']);
    $veiculo->setModelo($this->veiculo['modelo']);
    $veiculo->setCarType($this->veiculo['car_type']);
    return $veiculo;
  }

  private function getCarroInstance($id)
  {
    $carro = new Carro($id);
    $carro->setTamanhoMotor($this->veiculo['tamanho_motor']);
    return $carro;
  }

  private function getCaminhaoInstance($id)
  {
    $caminhao = new Caminhao($id);
    $caminhao->setCapacidadePeso($this->veiculo['capacidade_peso']);
    return $caminhao;
  }

  private function getUtilitarioInstance($id)
  {
    $utilitario = new Utilitario($id);
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
    $type = array();

    if ($this->veiculo['car_type'] == "carro") :
      $type = $carroRepository->create($this->getCarroInstance($veiculo['cod_veiculo']));
    endif;

    if ($this->veiculo['car_type'] == "caminhao") :
      $type = $caminhaoRepository->create($this->getCaminhaoInstance($veiculo['cod_veiculo']));
    endif;

    if ($this->veiculo['car_type'] == "utilitario") :
      $type = $utilitarioRepository->create($this->getUtilitarioInstance($veiculo['cod_veiculo']));
    endif;

    return json_encode(array_merge($veiculo, $type));
  }
}
