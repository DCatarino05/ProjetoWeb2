<?php

class Filme
{
    private $db;

    public function __construct()
    {
        // Conexão com a base de dados
        $this->db = Connection::getInstance();
    }

    // Lista todos os filmes
    public function listar()
    {
        try {
            $query = "SELECT * FROM filmes";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar filmes: ' . $e->getMessage());
            return [];
        }
    }

    // Busca um filme por ID
    public function buscarPorId($id)
    {
        try {
            if (!filter_var($id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID inválido.');
            }

            $query = "SELECT * FROM filmes WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Erro ao buscar filme por ID: ' . $e->getMessage());
            return null;
        }
    }

    // Cria um novo filme
    public function criar($dados)
    {
        try {
            $query = "INSERT INTO filmes (titulo, descricao, duracao, trailer, cartaz, idademinima, categoria) 
                      VALUES (:titulo, :descricao, :duracao, :trailer, :cartaz, :idade_minima, :categoria)";
            $stmt = $this->db->prepare($query);

            foreach ($dados as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao criar filme: ' . $e->getMessage());
            return false;
        }
    }

    // Atualiza um filme existente
    public function atualizar($dados)
    {
        try {
            $query = "UPDATE filmes 
                      SET titulo = :titulo, descricao = :descricao, duracao = :duracao, trailer = :trailer, 
                          cartaz = :cartaz, idademinima = :idade_minima, categoria = :categoria
                      WHERE id = :id";
            $stmt = $this->db->prepare($query);

            foreach ($dados as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar filme: ' . $e->getMessage());
            return false;
        }
    }

    // Exclui um filme
    public function excluir($id)
    {
        try {
            if (!filter_var($id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID inválido.');
            }

            $query = "DELETE FROM filmes WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log('Erro ao excluir filme: ' . $e->getMessage());
            return false;
        }
    }

    // Lista as categorias de filmes
    public function listarCategorias()
    {
        try {
            $query = "SELECT DISTINCT categoria FROM filmes";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar categorias: ' . $e->getMessage());
            return [];
        }
    }

    // Filtra filmes por categoria
    public function filtrarPorCategoria($categoria)
    {
        try {
            $query = "SELECT * FROM filmes WHERE categoria = :categoria";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao filtrar por categoria: ' . $e->getMessage());
            return [];
        }
    }

    // Filtra filmes por categoria e/ou título
    public function filtrar($categoria)
    {
        try {
            $query = "SELECT * FROM filmes WHERE categoria = :categoria";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao filtrar filmes: ' . $e->getMessage());
            return [];
        }
    }
}
