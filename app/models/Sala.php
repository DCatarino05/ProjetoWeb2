<?php

class Sala
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function listar()
    {
        $query = "SELECT * FROM salas";
        $stmt = $this->db->query($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM salas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function criar($dados)
    {
        $query = "INSERT INTO salas (nome, capacidade) VALUES (:nome, :capacidade)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($dados);
    }

    public function atualizar($dados)
    {
        $query = "UPDATE salas SET nome = :nome, capacidade = :capacidade WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($dados);
    }

    public function excluir($id)
    {
        $query = "DELETE FROM salas WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
