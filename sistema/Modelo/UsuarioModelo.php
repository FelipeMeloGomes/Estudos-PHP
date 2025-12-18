<?php

namespace sistema\Modelo;

use sistema\Nucleo\Modelo;
use sistema\Nucleo\Sessao;
use sistema\Nucleo\Helpers;

/**
 * Classe UsuarioModelo
 * 
 * @author Felipe Melo
 */

class UsuarioModelo extends Modelo
{
  public function __construct()
  {
    return parent::__construct('usuarios');
  }

  public function buscaPorEmail(string $email): ?UsuarioModelo
  {
    $busca = $this->busca("email = :e", "e={$email}");
    return $busca->resultado();
  }

  public function login(array $dados, int $level = 1)
  {
    $usuario = (new UsuarioModelo())->buscaPorEmail($dados['email']);

    if (!$usuario) {
      return false;
      $this->mensagem()->alert("Dados incorretos")->flash();
    }

    if (!Helpers::verificarSenha($dados['senha'], $usuario->senha)) {
      $this->mensagem()->alert("Senha incorreta")->flash();
      return false;
    }

    if ($usuario->status != 1) {
      $this->mensagem()->alert("Ative sua conta")->flash();
      return false;
    }

    if ($usuario->level < $level) {
      $this->mensagem()->alert("Usuário sem permissão")->flash();
      return false;
    }

    $usuario->ultimo_login = date('Y-m-d H:i:s');
    $usuario->salvar();

    (new Sessao())->create('usuarioId', $usuario->id);

    $this->mensagem()->success("{$usuario->nome}, seja bem vindo(a) ao painel de controle")->flash();

    return true;
  }

  public function salvar(): bool
  {
    if ($this->busca("email = :e AND id != :id", "e={$this->email}&id={$this->id}")->resultado()) {
      $this->mensagem->alert("O e-mail " . $this->dados->email . " já está cadastrado");
      return false;
    }
    parent::salvar();

    return true;
  }
}
