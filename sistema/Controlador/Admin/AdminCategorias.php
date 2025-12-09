<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;

/**
 * Classe AdminCategorias
 *
 * @author Felipe Melo
 */
class AdminCategorias extends AdminControlador
{
    public function listar(): void
    {
        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => (new CategoriaModelo())->busca()
        ]);
    }
    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        var_dump($dados);
        echo $this->template->renderizar('categorias/formulario.html', []);
    }
}
