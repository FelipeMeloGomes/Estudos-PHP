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

  /**
   * Cria uma sessão 
   * @param string $key
   * @param mixed $valor
   * @return Sessao
   */

  public function create(string $key, mixed $valor): Sessao
  {
    $_SESSION[$key] = (is_array($valor) ? (object) $valor : $valor);
    return $this;
  }

  /**
   * Carrega uma sessão
   * @return object|null
   */

  public function loading(): ?object
  {
    return (object) $_SESSION;
  }

  /**
   * Checa se uma sessão existe
   * @param string $key
   * @return bool
   */

  public function check(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  /**
   * Limpa a sessão especificada
   * @param string $key
   * @return Sessao
   */

  public function trash(string $key): Sessao
  {
    unset($_SESSION[$key]);
    return $this;
  }

  /**
   * Destrói todos os dados registrados em uma sessão
   * @return Sessao
   */

  public function delete(): Sessao
  {
    session_destroy();
    return $this;
  }

  public function __get($atributo)
  {
    if (!empty($_SESSION[$atributo])) {
      return $_SESSION[$atributo];
    }
  }

  /**
   * Destrói todoos os dados registrados em uma sessão
   * @return Sessao
   */

  public function flash(): ?Mensagem
  {
    if ($this->check('flash')) {
      $flash = $this->flash;
      $this->trash('flash');
      return $flash;
    }
    return null;
  }
}
