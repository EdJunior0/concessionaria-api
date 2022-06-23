<?php

namespace src\repositories;

require_once 'vendor/autoload.php';

use src\config\Connection;
use src\models\User;

class UserRepository
{

  public function create(User $user)
  {
    $sql = 'INSERT INTO my_user (email, senha, nome) VALUES (?,?,?) RETURNING email';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $user->getEmail());
    $stmt->bindValue(2, $user->getSenha());
    $stmt->bindValue(3, $user->getNome());
    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function find()
  {
    $sql = 'SELECT * FROM user';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) :
      $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      return $resultado;
    else :
      return [];
    endif;
  }

  public function findOne($email)
  {
    $sql = 'SELECT * FROM my_user WHERE email = ?';

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->bindValue(1, $email);
    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "email" => $response['email'],
      "senha" => $response['senha'],
      "nome" => $response['nome']
    );
  }

  public function findOneByName($nome)
  {
    $sql = "SELECT * FROM my_user WHERE nome LIKE '%$nome%'";

    $stmt = Connection::getConn()->prepare($sql);

    $stmt->execute();

    $response = $stmt->fetch();

    return array(
      "email" => $response['email'],
      "senha" => $response['senha'],
      "nome" => $response['nome'],
    );
  }

  public function update(User $user)
  {

    $sql = 'UPDATE my_user SET nome = ? WHERE email = ? RETURNING email';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $user->getNome());
    $stmt->bindValue(2, $user->getEmail());

    $stmt->execute();

    $response = $stmt->fetch();
    return $response;
  }

  public function delete($email)
  {

    $sql = 'DELETE FROM my_user WHERE email = ?';

    $stmt = Connection::getConn()->prepare($sql);
    $stmt->bindValue(1, $email);
    $stmt->execute();
  }
}
