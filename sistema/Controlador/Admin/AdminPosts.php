<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\PostModelo;
use sistema\Modelo\CategoriaModelo;
use sistema\Nucleo\Helpers;

/**
 * Classe AdminPosts
 *
 * @author Felipe Melo
 */
class AdminPosts extends AdminControlador
{
    public function listar(): void
    {
        $post = new PostModelo();
        echo $this->template->renderizar('posts/listar.html', [
            'posts' => $post->findAll(),
            'total' => [
                'total' => $post->count(),
                'ativo' => $post->count('status = 1'),
                'inativo' => $post->count('status = 0'),
            ]
        ]);
    }

    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModelo())->create($dados);
            Helpers::redirecionar('admin/posts/listar');
        }
        echo $this->template->renderizar('posts/formulario.html', ['categorias' => (new CategoriaModelo())->findAll()]);
    }

    public function editar(int $id): void
    {
        $post = (new PostModelo())->find($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            (new PostModelo())->update($dados, $id);
            Helpers::redirecionar('admin/posts/listar');
        }
        echo $this->template->renderizar(
            'posts/formulario.html',
            [
                'post' => $post,
                'categorias' => (new CategoriaModelo())->findAll()
            ]
        );
    }

    public function deletar(int $id): void
    {
        (new PostModelo())->delete($id);
        Helpers::redirecionar('admin/posts/listar');
    }
}
