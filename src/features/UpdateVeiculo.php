<?php

namespace src\features;

require_once 'vendor/autoload.php';

use src\models\Caminhao;
use src\models\Carro;
use src\models\Utilitario;
use src\models\Veiculo;
use src\repositories\CaminhaoRepository;
use src\repositories\CarroRepository;
use src\repositories\UtilitarioRepository;
use src\repositories\VeiculoRepository;

class UpdateVeiculo
{

  private $veiculo;

  public function __construct($veiculo)
  {
    $this->veiculo = $veiculo;
  }

  private function getVeiculoInstance($payload)
  {
    $veiculo = new Veiculo($payload['cod_veiculo']);
    $veiculo->setPreco($payload['preco']);
    $veiculo->setModelo($payload['modelo']);
    $veiculo->setCarType($payload['car_type']);
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

  public function updateVeiculo()
  {
    $veiculoRepository = new VeiculoRepository();
    $carroRepository = new CarroRepository();
    $caminhaoRepository = new CaminhaoRepository();
    $utilitarioRepository = new UtilitarioRepository();

    $veiculo = $this->getVeiculoInstance($this->veiculo);

    $veiculoFinded = $veiculoRepository->findOne($veiculo->getCodVeiculo());
    if (!$veiculoFinded['cod_veiculo']) :
      return json_encode(array(
        "message" => "veiculo not found!"
      ));
    endif;

    $type = array();

    if (!$veiculo->getPreco()) :
      $veiculo->setPreco($veiculoFinded['preco']);
    endif;

    if (!$veiculo->getModelo()) :
      $veiculo->setModelo($veiculoFinded['modelo']);
    endif;

    if ($this->veiculo['tamanho_motor']) :
      $type = $carroRepository->update($this->getCarroInstance());
    endif;

    if ($this->veiculo['capacidade_peso']) :
      $type = $caminhaoRepository->update($this->getCaminhaoInstance());
    endif;

    if ($this->veiculo['nr_assentos']) :
      $type = $utilitarioRepository->update($this->getUtilitarioInstance());
    endif;

    $veiculoUpdated = $veiculoRepository->update($veiculo);

    return json_encode(array_merge($veiculoUpdated, $type));
  }
}
