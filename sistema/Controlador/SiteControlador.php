<?php

namespace sistema\Controlador;

use sistema\Nucleo\Controlador;

class SiteControlador extends Controlador
{
  public function __construct()
  {
    parent::__construct('templates/site/views');
  }

  public function index(): void
  {
    echo $this->template->renderizar('index.html', ['titulo' => 'Pagina Inicial do Site', 'conteudo' => 'Bem vindo ao nosso site!']);
  }

  public function sobre(): void
  {
     echo $this->template->renderizar('index.html', ['titulo' => 'Pagina Inicial do Site', 'conteudo' => 'Bem vindo ao nosso site!']);
  }
}
