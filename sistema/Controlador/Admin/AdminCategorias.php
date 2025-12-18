<?php

namespace sistema\Controlador\Admin;

use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\PostModelo;
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
        $categorias = new CategoriaModelo();

        echo $this->template->renderizar('categorias/listar.html', [
            'categorias' => $categorias->busca()->ordem('titulo ASC')->resultado(true),
            'total' => [
                'categorias' => $categorias->total(),
                'categoriasAtiva' => $categorias->busca('status = 1')->total(),
                'categoriasInativa' => $categorias->busca('status = 0')->total()
            ]
        ]);
    }

    public function cadastrar(): void
    {
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            if ($this->validarDados($dados)) {
                $categoria = new CategoriaModelo();

                $categoria->titulo = $dados['titulo'];
                $categoria->texto = $dados['texto'];
                $categoria->status = $dados['status'];
                $categoria->cadastrado_em = date('Y-m-d H:i:s');

                if ($categoria->salvar()) {
                    $this->mensagem->success('Categoria cadastrada com sucesso')->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                } else {
                    $this->mensagem->error($categoria->erro())->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                }
            }
        }

        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria' => $dados
        ]);
    }

    public function editar(int $id): void
    {
        $categoria = (new CategoriaModelo())->buscaPorId($id);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            if ($this->validarDados($dados)) {
                $categoria = (new CategoriaModelo())->buscaPorId($categoria->id);

                $categoria->titulo = $dados['titulo'];
                $categoria->texto = $dados['texto'];
                $categoria->status = $dados['status'];
                $categoria->atualizado_em = date('Y-m-d H:i:s');

                if ($categoria->salvar()) {
                    $this->mensagem->success('Categoria atualizada com sucesso')->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                } else {
                    $this->mensagem->error($categoria->erro())->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                }
            }
        }

        echo $this->template->renderizar('categorias/formulario.html', [
            'categoria' => $categoria
        ]);
    }

    private function validarDados(array $dados): bool
    {
        if (empty($dados['titulo'])) {
            $this->mensagem->alert('Escreva um título para a Categoria!')->flash();
            return false;
        }
        return true;
    }

    public function deletar(int $id): void
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (is_int($id)) {
            $categoria = (new CategoriaModelo())->buscaPorId($id);

            if (!$categoria) {
                $this->mensagem->alert('A categoria que você está tentando deletar não existe!')->flash();
                Helpers::redirecionar('admin/categorias/listar');
            } else if ($categoria->posts($categoria->id)) {
                $this->mensagem->alert("A categoria {$categoria->titulo} tem posts cadastrados, delete ou altere os posts antes de deletar!")->flash();
                Helpers::redirecionar('admin/categorias/listar');
            } else {
                if ($categoria->deletar()) {
                    $this->mensagem->success('Categoria Apagada com sucesso')->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                } else {
                    $this->mensagem->error($categoria->erro())->flash();
                    Helpers::redirecionar('admin/categorias/listar');
                }
            }
        }
    }
}
