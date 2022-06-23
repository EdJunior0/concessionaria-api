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
    $PORT = getenv("PORT");
    $DB_NAME = getenv("DB_NAME");
    $BD_USER = getenv("BD_USER");
    $DB_PASSWORD = getenv("DB_PASSWORD");
    $CONN = "pgsql:host=" . $HOST . ";port=" . $PORT . ";dbname=" . $DB_NAME;
    if (!isset(self::$instance)) :
      self::$instance = new PDO($CONN, $BD_USER, $DB_PASSWORD);
    endif;

    return self::$instance;
  }
}
