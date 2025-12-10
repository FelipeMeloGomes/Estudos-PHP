<?php

namespace sistema\Nucleo;

/**
 * Classe responsável pelo gerenciamento de sessões do sistema.
 * 
 * @author Felipe Melo
 */


class Sessao
{
  public function __construct()
  {
    if (!session_id()) {
      session_start();
    }
  }

  public function create(string $key, mixed $valor): Sessao
  {
    $_SESSION[$key] = (is_array($valor) ? (object) $valor : $valor);
    return $this;
  }

  public function loading(): ?object
  {
    return (object) $_SESSION;
  }

  public function check(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  public function trash(string $key): Sessao
  {
    unset($_SESSION[$key]);
    return $this;
  }

  public function delete(): Sessao
  {
    session_destroy();
    return $this;
  }
}
