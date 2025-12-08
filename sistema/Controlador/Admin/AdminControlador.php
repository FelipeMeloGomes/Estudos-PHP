<?php

namespace sistema\Controlador\Admin;

use sistema\Nucleo\Controlador;

class AdminControlador extends Controlador
{
  public function __construct()
  {
    return parent::__construct('templates/admin/views');
  }
}
