<?php

namespace src\features;

require_once 'vendor/autoload.php';

use src\repositories\CaminhaoRepository;
use src\repositories\CarroRepository;
use src\repositories\UtilitarioRepository;
use src\repositories\VeiculoRepository;

class DeleteVeiculo
{

  private $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function deleteVeiculo()
  {
    $veiculoRepository = new VeiculoRepository();
    $carroRepository = new CarroRepository();
    $caminhaoRepository = new CaminhaoRepository();
    $utilitarioRepository = new UtilitarioRepository();

    $veiculo = $veiculoRepository->findOne($this->id);
    if (!$veiculo['cod_veiculo']) :
      return json_encode(array(
        "message" => "veiculo not found"
      ));
    endif;

    if ($veiculo['car_type'] == "carro") :
      $carroRepository->delete($veiculo['cod_veiculo']);
    endif;

    if ($veiculo['car_type'] == "caminhao") :
      $caminhaoRepository->delete($veiculo['cod_veiculo']);
    endif;

    if ($veiculo['car_type'] == "utilitario") :
      $utilitarioRepository->delete($veiculo['cod_veiculo']);
    endif;

    $veiculoRepository->delete($this->id);

    return json_encode(array(
      "message" => "veiculo deleted"
    ));
  }
}
