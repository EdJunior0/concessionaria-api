<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use PDO;
use src\config\Connection;
use src\models\Veiculo;

class VeiculoRepository
{
  public function create(Veiculo $veiculo)
  {
    $sql = 'INSERT INTO veiculo (cod_veiculo, preco, modelo, car_type) VALUES (?,?,?,?) RETURNING cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $veiculo->getCodVeiculo());
    $stmt->bindValue(2, $veiculo->getPreco());
    $stmt->bindValue(3, $veiculo->getModelo());
    $stmt->bindValue(4, $veiculo->getCarType());
    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM veiculo';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) :
      $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $resultado;
    else :
      return [];
    endif;
  }

  public function findOne($id)
  {
    $sql = 'SELECT * FROM veiculo WHERE cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $id);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['cod_veiculo'],
      "preco" => (float) $response['preco'],
      "modelo" => $response['modelo'],
      "car_type" => $response['car_type']
    );
  }

  public function findOneByModel($modelo)
  {
    $sql = "SELECT * FROM veiculo WHERE modelo LIKE '%$modelo%'";

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['cod_veiculo'],
      "preco" => (float) $response['preco'],
      "modelo" => $response['modelo'],
      "car_type" => $response['car_type']
    );
  }

  public function update(Veiculo $veiculo)
  {

    $sql = 'UPDATE veiculo SET preco = ?, modelo = ? WHERE cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $veiculo->getPreco());
    $stmt->bindValue(2, $veiculo->getModelo());
    $stmt->bindValue(3, $veiculo->getCodVeiculo());

    $stmt->execute();
  }

  public function delete($id)
  {

    $sql = 'DELETE FROM veiculo WHERE cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}
