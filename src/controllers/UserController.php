<?php

namespace src\controllers;

use src\features\CreateUser;
use src\features\GetUser;

require_once 'vendor/autoload.php';

class UserController
{

  private $method;
  private $payload;
  const GET = 'get';
  const POST = 'post';
  const PATCH = 'patch';
  const DELETE = 'delete';

  public function __construct($method, $payload)
  {
    $this->method = $method;
    $this->payload = $payload;
  }

  public function userController()
  {
    switch ($this->method) {
      case self::GET:

        if ($this->payload['email']) {
          $user = new GetUser($this->payload['email'], $this->payload['senha']);
          echo $user->getuser();
        } elseif ($this->payload['nome']) {

          // $user = new GetuserByNome($this->payload['nome']);
          // echo $user->getuserByNome();
        } else {

          // $user = new Getuseres();
          // echo $user->getuseres();
        }
        break;

      case self::POST:
        $user = new CreateUser($this->payload);
        echo $user->createuser();
        break;

      case self::PATCH:
        // $user = new Updateuser($this->payload);
        // echo $user->updateuser();
        break;

      case self::DELETE:
        // $user = new Deleteuser($this->payload['cod_user']);
        // echo $user->deleteuser();
        break;

      default:
        break;
    }
  }
}
