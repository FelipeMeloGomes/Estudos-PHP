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
    echo $this->template->renderizar('index.html', ['title' => 'Pagina Inicial', 'subtitle' => 'teste subtitulo']);
  }

  public function sobre(): void
  {
    echo $this->template->renderizar('sobre-nos.html', ['title' => 'Sobre nós', 'subtitle' => 'Bem vindo ao nosso site!']);
  }
}
