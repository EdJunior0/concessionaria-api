<?php

namespace src\features;

use src\repositories\UserRepository;

require_once 'vendor/autoload.php';

class GetUser
{

  private $email;

  public function __construct($email)
  {
    $this->email = $email;
  }

  public function getUser()
  {
    $userRepository = new UserRepository();

    $user = $userRepository->findOne($this->email);

    if ($user['email']) :
      return json_encode($user);
    else :
      return json_encode(array(
        "message" => "user not found!"
      ));
    endif;
  }
}
