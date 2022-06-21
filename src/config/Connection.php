<?php

namespace src\config;

require_once 'vendor/autoload.php';

use PDO;

class Connection
{
  private static $instance;

  public static function getConn()
  {
    if (!isset(self::$instance)) :
      self::$instance = new PDO("pgsql:host=localhost;port=5432;dbname=concessionaria", "postgres", "123456");
    endif;
    
    return self::$instance;
  }
}