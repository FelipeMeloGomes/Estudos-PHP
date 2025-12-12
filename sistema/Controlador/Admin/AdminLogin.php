<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminLogin
 *
 * @author Felipe Melo
 */
class AdminLogin extends Controlador
{
  public function __construct()
  {
    parent::__construct('templates/admin/views');
  }

  public function login(): void
  {
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    if (isset($dados)) {
      if ($this->checarDados($dados)) {
        $this->mensagem->success('dados válidos')->flash();
      }
    }
    echo $this->template->renderizar('login.html', []);
  }

  private function checarDados(array $dados): bool
  {
    if (empty($dados['email'])) {
      $this->mensagem->alert('Campo Email é obrigatório')->flash();
      return false;
    }
    if (empty($dados['senha'])) {
      $this->mensagem->alert('Campo Senha é obrigatório')->flash();
      return false;
    }
    return true;
  }
}
