<?php

namespace sistema\Nucleo;

/**
 * Classe Mensagem – responsável por exibir as mensagens do sistema.
 * @author Felipe Melo
 */
class Mensagem
{

    private $texto;
    private $css;

    public function __toString()
    {
        return $this->renderizar();
    }

    /**
     * Método responsável pelas mensagens de sucesso
     * @param string $mensagem
     * @return Mensagem
     */
    public function success(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-success';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Método responsável pelas mensagens de erro
     * @param string $mensagem
     * @return Mensagem
     */
    public function error(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-danger';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Método responsável pelas mensagens de alerta
     * @param string $mensagem
     * @return Mensagem
     */
    public function alert(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-warning';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Método responsável pelas mensagens de edição
     * @param string $mensagem
     * @return Mensagem
     */
    public function edit(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-info';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Método responsável pelas mensagens de informações
     * @param string $mensagem
     * @return Mensagem
     */
    public function informa(string $mensagem): Mensagem
    {
        $this->css = 'alert alert-primary';
        $this->texto = $this->filtrar($mensagem);
        return $this;
    }

    /**
     * Método responsável pela renderização das mensagens
     * @return string
     */
    public function renderizar(): string
    {
        return "<div class='{$this->css}'>{$this->texto}</div>";
    }

    /**
     * Método responsável por filtrar as mensagens
     * @param string $mensagem
     * @return string
     */
    private function filtrar(string $mensagem): string
    {
        return filter_var($mensagem, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    /**
     * Método responsável por filtrar as mensagens
     * @param string $mensagem
     * @return string
     */
    public function flash(): void
    {
        (new Sessao())->create('flash', $this);
    }
}
