<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\Cliente;

class ClienteRepository
{

  public function create(Cliente $cliente)
  {
    $sql = 'INSERT INTO cliente (cpf, nome, endereco) VALUES (?,?,?) RETURNING cpf';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $cliente->getCpf());
    $stmt->bindValue(2, $cliente->getNome());
    $stmt->bindValue(3, $cliente->getEndereco());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM cliente';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) :
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    else :
      return [];
    endif;
  }

  public function findOne($cpf)
  {
    $sql = 'SELECT * FROM cliente WHERE cpf = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $cpf);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cpf" => $response['cpf'],
      "nome" => $response['nome'],
      "endereco" => $response['endereco']
    );
  }

  public function findOneByName($nome)
  {
    $sql = "SELECT * FROM cliente WHERE nome LIKE '%$nome%'";

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "cpf" => $response['cpf'],
      "nome" => $response['nome'],
      "endereco" => $response['endereco']
    );
  }

  public function update(Cliente $cliente)
  {

    $sql = 'UPDATE cliente SET nome = ?, endereco = ? WHERE cpf = ? RETURNING cpf';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $cliente->getNome());
    $stmt->bindValue(2, $cliente->getEndereco());
    $stmt->bindValue(3, $cliente->getCpf());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($cpf)
  {

    $sql = 'DELETE FROM cliente WHERE cpf = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $cpf);
    $stmt->execute();
  }
}
