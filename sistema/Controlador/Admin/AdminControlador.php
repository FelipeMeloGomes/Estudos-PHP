<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminControlador
 *
 * @author Felipe Melo
 */
class AdminControlador extends Controlador
{
  public function __construct()
  {
    parent::__construct('templates/admin/views');

    $usuario = false;

    if (!$usuario) {
      $this->mensagem->error('Faça Login para acessar o painel de controle!')->flash();

      Helpers::redirecionar('admin/login');
    }
  }
}
