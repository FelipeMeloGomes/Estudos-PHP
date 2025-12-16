<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;
use sistema\Controlador\UsuarioControlador;
use sistema\Nucleo\Sessao;

/**
 * Classe AdminControlador
 *
 * @author Felipe Melo
 */
class AdminControlador extends Controlador
{
  protected $usuario;

  public function __construct()
  {
    parent::__construct('templates/admin/views');

    $this->usuario = UsuarioControlador::usuario();

    if (!$this->usuario || $this->usuario->level != 3) {
      $this->mensagem->error('Faça Login para acessar o painel de controle!')->flash();

      $sessao = new Sessao();
      $sessao->trash('usuarioId');

      Helpers::redirecionar('admin/login');
    }
  }
}
