<?php

namespace sistema\Nucleo;

class Mensagem
{
  private $texto;
  private $css;

  public function __toString()
  {
    return $this->renderizar();
  }

  public function sucesso(string $mensagem): Mensagem
  {
    $this->texto = $this->filtrar($mensagem);
    $this->css = 'alert alert-success';
    return $this;
  }

  /** 
   * Metodo para renderizar a mensagem
   * @return string
   */

  public function renderizar(): string
  {
    return  "<div class= '{$this->css}'>{$this->texto}</div>";
  }

  private function filtrar(string $mensagem): string
  {
    return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
  }
}
