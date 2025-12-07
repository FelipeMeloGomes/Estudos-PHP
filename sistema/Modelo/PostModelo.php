<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;

class PostModelo
{
  public function ler(): array
  {
    $query = "SELECT * FROM posts";
    $stmt = Conexao::getInstancia()->query($query);
    $resultado = $stmt->fetchAll();

    return $resultado;
  }
}
