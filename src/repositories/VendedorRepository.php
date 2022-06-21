<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Vendedor;

class VendedorRepository
{

  public function create(Vendedor $vendedor)
  {
    $sql = 'INSERT INTO vendedor (cod_vendedor, nome) VALUES (?,?)';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $vendedor->getCodVendedor());
    $stmt->bindValue(2, $vendedor->getNome());
    $stmt->execute();
  }

  public function find()
  {
    $sql = 'SELECT * FROM vendedor';

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
    $sql = 'SELECT * FROM vendedor WHERE cod_vendedor = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $id);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_vendedor" => $response['cod_vendedor'],
      "nome" => $response['nome']
    );
  }

  public function findOneByName($nome)
  {
    $sql = "SELECT * FROM vendedor WHERE nome LIKE '%$nome%'";

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cod_vendedor" => $response['cod_vendedor'],
      "nome" => $response['nome'],
    );
  }

  public function update(Vendedor $vendedor)
  {

    $sql = 'UPDATE vendedor SET nome = ? WHERE cod_vendedor = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $vendedor->getNome());
    $stmt->bindValue(2, $vendedor->getCodVendedor());

    $stmt->execute();
  }

  public function delete($id)
  {

    $sql = 'DELETE FROM vendedor WHERE cod_vendedor = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $id);
    $stmt->execute();
  }
}
