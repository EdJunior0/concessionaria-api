<?php

namespace src\features;

use src\models\User;
use src\repositories\UserRepository;

require_once 'vendor/autoload.php';

class CreateUser
{

  private $user;

  public function __construct($user)
  {
    $this->user = $user;
  }

  private function getUserInstance()
  {
    $user = new User();
    $user->setEmail($this->user['email']);
    $user->setSenha($this->user['senha']);
    $user->setNome($this->user['nome']);
    return $user;
  }

  public function createUser()
  {
    $userRepository = new UserRepository();

    $userFinded = $userRepository->findOne($this->getUserInstance()->getEmail(), $this->getUserInstance()->getSenha());

    if ($userFinded['email']) {
      return json_encode(array(
        "message" => "user alredy exists!"
      ));
    }

    $user = $userRepository->create($this->getuserInstance());

    return json_encode($user);
  }
}
