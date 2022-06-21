<?php

namespace src\features;

require_once 'vendor/autoload.php';

use src\repositories\CaminhaoRepository;
use src\repositories\CarroRepository;
use src\repositories\UtilitarioRepository;
use src\repositories\VeiculoRepository;

class GetVeiculoByModel
{

  private $model;

  public function __construct($model)
  {
    $this->model = $model;
  }

  public function getVeiculoByModel()
  {
    $veiculoReposiry = new VeiculoRepository();
    $carroRepository = new CarroRepository();
    $caminhaoRepository = new CaminhaoRepository();
    $utilitarioRepository = new UtilitarioRepository();

    $veiculo = $veiculoReposiry->findOneByModel($this->model);

    if ($veiculo['car_type'] == "carro") :
      $carro = $carroRepository->findOne($veiculo['cod_veiculo']);
      return json_encode(array_merge($veiculo, $carro));
    endif;

    if ($veiculo['car_type'] == "caminhao") :
      $caminhao = $caminhaoRepository->findOne($veiculo['cod_veiculo']);
      return json_encode(array_merge($veiculo, $caminhao));
    endif;

    if ($veiculo['car_type'] == "utilitario") :
      $utilitario = $utilitarioRepository->findOne($veiculo['cod_veiculo']);
      return json_encode(array_merge($veiculo, $utilitario));
    endif;

    if ($veiculo['cod_veiculo']) :
      return json_encode($veiculo);
    else :
      return json_encode(array(
        "message" => "veiculo not found!"
      ));
    endif;
  }
}
