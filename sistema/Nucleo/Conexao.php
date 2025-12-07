<?php

namespace sistema\Nucleo;

use PDO;
use PDOException as Exception;

class Conexao
{
  private static $instancia;

  public static function getInstancia(): PDO
  {
    if (empty(self::$instancia)) {
      try {
        self::$instancia = new PDO(
          'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME,
          DB_USER,
          DB_PASSWORD,
          [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
          ]
        );
      } catch (Exception $e) {
        die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
      }
    }
    return self::$instancia;
  }

  protected function __construct() {}

  private function __clone(): void {}
}
