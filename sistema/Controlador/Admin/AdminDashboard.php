<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Sessao;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminDashboard
 *
 * @author Felipe Melo
 */
class AdminDashboard extends AdminControlador
{
  public function dashboard(): void
  {
    echo $this->template->renderizar('dashboard.html', []);
  }

  public function sair(): void
  {
    $sessao = new Sessao();
    $sessao->trash('usuarioId');

    $this->mensagem->informa('Você saiu do painel de controle!')->flash();
    Helpers::redirecionar('admin/login');
  }
}
