<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Carro;

class CarroRepository
{

  public function create(Carro $carro)
  {
    $sql = 'INSERT INTO carro (tamanho_motor) VALUES (?) RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $carro->getTamanhoMotor());
    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM carro';

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
    $sql = 'SELECT * FROM carro WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $id);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['veiculo_fk_cod_veiculo'],
      "tamanho_motor" => $response['tamanho_motor']
    );
  }

  public function update(Carro $carro)
  {

    $sql = 'UPDATE carro SET tamanho_motor = ? WHERE veiculo_fk_cod_veiculo = ? RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $carro->getTamanhoMotor());
    $stmt->bindValue(2, $carro->getCodVeiculo());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($id)
  {

    $sql = 'DELETE FROM carro WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}
