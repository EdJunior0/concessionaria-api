<?php

namespace src\config;

require_once 'vendor/autoload.php';

use PDO;

class Connection
{
  private static $instance;

  public static function getConn()
  {
    $HOST = "ec2-52-72-56-59.compute-1.amazonaws.com";
    $DB_NAME = "d98ctljod9kohm";
    $BD_USER = "mykgrcdtvwbtbo";
    $DB_PASSWORD = "8a04b2a2fa76648b42115498d343cb988cc6a8451c9b62b851e6e62e55186ed8";
    $CONN = "pgsql:host=$HOST;port=5432;dbname=$DB_NAME";
    if (!isset(self::$instance)) :
      self::$instance = new PDO($CONN, $BD_USER, $DB_PASSWORD);
    endif;

    return self::$instance;
  }
}
