<?php

namespace src\config;

require_once 'vendor/autoload.php';

use PDO;

class Connection
{
  private static $instance;

  public static function getConn()
  {
    $HOST = apache_getenv("HOST");
    $PORT = apache_getenv("PORT");
    $DB_NAME = apache_getenv("DB_NAME");
    $BD_USER = apache_getenv("BD_USER");
    $DB_PASSWORD = apache_getenv("DB_PASSWORD");
    $CONN = "pgsql:host=" . $HOST . ";port=" . $PORT . ";dbname=" . $DB_NAME;
    if (!isset(self::$instance)) :
      self::$instance = new PDO($CONN, $BD_USER, $DB_PASSWORD);
    endif;

    return self::$instance;
  }
}
