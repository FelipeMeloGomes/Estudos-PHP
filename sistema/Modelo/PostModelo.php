<?php

namespace sistema\Modelo;

use sistema\Nucleo\Conexao;

/**
 * Classe PostModelo
 *
 * @author Felipe Melo
 */
class PostModelo
{
    public function findAll(): array
    {
        $query = "SELECT * FROM posts WHERE status = 1 ORDER BY id DESC ";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function find(int $id): bool|object
    {
        $query = "SELECT * FROM posts WHERE id = {$id} ";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetch();

        return $resultado;
    }

    public function search(string $busca): array
    {
        $query = "SELECT * FROM posts WHERE status = 1 AND titulo LIKE '%{$busca}%' ";
        $stmt = Conexao::getInstancia()->query($query);
        $resultado = $stmt->fetchAll();

        return $resultado;
    }

    public function create(array $dados): void
    {
        $query = "INSERT INTO posts (categoria_id, titulo, texto, status) VALUES (:categoria_id, :titulo, :texto, :status);";
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute($dados);
    }

    public function update(array $dados, int $id): void
    {
        $query = "UPDATE posts SET categoria_id = :categoria_id, titulo = :titulo, texto = :texto, status = :status WHERE id = {$id};";
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute($dados);
    }

    public function delete(int $id): void
    {
        $query = "DELETE FROM posts WHERE id = {$id};";
        $stmt = Conexao::getInstancia()->prepare($query);
        $stmt->execute();
    }
}
