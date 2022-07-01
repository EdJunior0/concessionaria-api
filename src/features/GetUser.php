<?php

namespace src\features;

use src\repositories\UserRepository;

require_once 'vendor/autoload.php';

class GetUser
{

  private $email;
  private $senha;

  public function __construct($email, $senha)
  {
    $this->email = $email;
    $this->senha = $senha;
  }

  public function getUser()
  {
    $userRepository = new UserRepository();

    $user = $userRepository->findOne($this->email, $this->senha);

    if ($user['email']) :
      return json_encode($user);
    else :
      return json_encode(array(
        "message" => "user not found!"
      ));
    endif;
  }
}
