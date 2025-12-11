<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminCategorias
 *
 * @author Felipe Melo
 */
class AdminCategorias extends AdminControlador
{
    public function listar(): void
    {
        $categoria = new CategoriaModelo();
        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => $categoria->findAll(),
            'total' => [
                'total' => $categoria->count(),
                'ativo' => $categoria->count('status = 1'),
                'inativo' => $categoria->count('status = 0'),
            ]
        ]);
    }


    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoriaModelo())->create($dados);
            $this->mensagem->success('Categoria cadastrada com sucesso')->flash();
            Helpers::redirecionar('admin/categorias/listar');
        }
        echo $this->template->renderizar('categorias/formulario.html', []);
    }

    public function editar(int $id): void
    {
        $categoria = (new CategoriaModelo())->find($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new CategoriaModelo())->update($dados, $id);
            $this->mensagem->edit('Categoria Editada com sucesso')->flash();
            Helpers::redirecionar('admin/categorias/listar');
        }

        echo $this->template->renderizar('categorias/formulario.html', ['categoria' => $categoria,]);
    }

    public function deletar(int $id): void
    {
        (new CategoriaModelo())->delete($id);
        $this->mensagem->alert('Categoria Apagada com sucesso')->flash();
        Helpers::redirecionar('admin/categorias/listar');
    }
}
