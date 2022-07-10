<?php

namespace src\config;

require_once 'vendor/autoload.php';

use PDO;

class Connection
{
  private static $instance;

  public static function getConn()
  {
    $HOST = getenv("HOST");
    $DB_NAME = getenv("DB_NAME");
    $BD_USER = getenv("DB_USER");
    $DB_PASSWORD = getenv("DB_PASSWORD");
    $CONN = "pgsql:host=$HOST;port=5432;dbname=$DB_NAME";
    if (!isset(self::$instance)) :
      self::$instance = new PDO($CONN, $BD_USER, $DB_PASSWORD);
    endif;

    return self::$instance;
  }
}
