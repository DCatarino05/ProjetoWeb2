<?php

class Sessao
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance(); 
    }

    public function listar()
{
    $query = "SELECT 
                  s.id, 
                  s.filme_id, 
                  s.sala_id, 
                  s.dataehora, 
                  s.preco,
                  f.titulo AS filme_nome, 
                  sa.nome AS sala_nome 
              FROM sessoes s
              LEFT JOIN filmes f ON s.filme_id = f.id
              LEFT JOIN salas sa ON s.sala_id = sa.id";
              
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function buscarPorId($id)
    {
        $query = "SELECT * FROM sessoes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function buscarPorIdFilme($id)
{
    
    $query = "SELECT 
                  s.id, 
                  s.filme_id, 
                  s.sala_id, 
                  s.dataehora, 
                  s.preco,
                  sa.nome AS sala_nome 
              FROM sessoes s
              LEFT JOIN salas sa ON s.sala_id = sa.id
              WHERE s.filme_id = :id";
              
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function criar($dados)
    {
        $query = "INSERT INTO sessoes (filme_id, sala_id, dataehora, preco) VALUES (:filme_id, :sala_id, :dataehora, :preco)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($dados);
    }

    public function atualizar($dados)
    {
        $query = "UPDATE sessoes SET filme_id = :filme_id, sala_id = :sala_id, dataehora = :dataehora, preco = :preco WHERE id = :id";
        $stmt = $this->db->prepare($query);
    
        if (!$stmt->execute($dados)) {
            var_dump($stmt->errorInfo());
            exit;
        }
    
        return true;
    }    

    public function excluir($id)
    {
        $query = "DELETE FROM sessoes WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
