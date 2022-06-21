<?php

namespace src\features;

require_once 'vendor/autoload.php';

use src\repositories\CaminhaoRepository;
use src\repositories\CarroRepository;
use src\repositories\UtilitarioRepository;
use src\repositories\VeiculoRepository;

class GetVeiculo
{

  private $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function getVeiculo()
  {
    $veiculoReposiry = new VeiculoRepository();
    $carroRepository = new CarroRepository();
    $caminhaoRepository = new CaminhaoRepository();
    $utilitarioRepository = new UtilitarioRepository();

    $veiculo = $veiculoReposiry->findOne($this->id);

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
