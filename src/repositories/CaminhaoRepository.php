<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Caminhao;

class CaminhaoRepository
{

  public function create(Caminhao $caminhao)
  {
    $sql = 'INSERT INTO caminhao (capacidade_peso) VALUES (?) RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $caminhao->getCapacidadePeso());
    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM caminhao';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) :
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    else :
      return [];
    endif;
  }

  public function findOne($id)
  {
    $sql = 'SELECT * FROM caminhao WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $id);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['veiculo_fk_cod_veiculo'],
      "capacidade_peso" => $response['capacidade_peso']
    );
  }

  public function update(Caminhao $caminhao)
  {

    $sql = 'UPDATE caminhao SET capacidade_peso = ? WHERE veiculo_fk_cod_veiculo = ? RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $caminhao->getCapacidadePeso());
    $stmt->bindValue(2, $caminhao->getCodVeiculo());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($id)
  {

    $sql = 'DELETE FROM caminhao WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}
