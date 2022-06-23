<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Utilitario;

class UtilitarioRepository
{

  public function create(Utilitario $utilitario)
  {
    $sql = 'INSERT INTO utilitario (veiculo_fk_cod_veiculo, nr_assentos) VALUES (?,?) RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $utilitario->getCodVeiculo());
    $stmt->bindValue(2, $utilitario->getNrAssentos());
    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM utilitario';

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
    $sql = 'SELECT * FROM utilitario WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $id);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_veiculo" => $response['veiculo_fk_cod_veiculo'],
      "nr_assentos" => $response['nr_assentos']
    );
  }

  public function update(Utilitario $utilitario)
  {

    $sql = 'UPDATE utilitario SET nr_assentos = ? WHERE veiculo_fk_cod_veiculo = ? RETURNING veiculo_fk_cod_veiculo';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $utilitario->getNrAssentos());
    $stmt->bindValue(2, $utilitario->getCodVeiculo());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($id)
  {

    $sql = 'DELETE FROM utilitario WHERE veiculo_fk_cod_veiculo = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}
