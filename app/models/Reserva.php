<?php

class Reserva
{
    private $db;

    public function __construct()
    {
        // Conexão com a base de dados
        $this->db = Connection::getInstance();
    }

    // Lista todas as reservas
    public function listar()
    {
        try {
            $query = "SELECT * FROM reservas";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar reservas: ' . $e->getMessage());
            return [];
        }
    }

    // Busca reservas por ID da sessão
    public function buscarPorSessao($sessao_id)
    {
        try {
            if (!filter_var($sessao_id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID da sessão inválido.');
            }

            $query = "SELECT * FROM reservas WHERE sessao_id = :sessao_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':sessao_id', $sessao_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Erro ao buscar reservas por sessão: ' . $e->getMessage());
            return [];
        }
    }

    public function buscarPorSessaoLugar($sessao_id)
    {
        $query = $this->db->prepare('SELECT lugar_nmr FROM reservas WHERE sessao_id = :sessao_id');
        $query->execute([':sessao_id' => $sessao_id]);
        $result = $query->fetchAll(PDO::FETCH_COLUMN); // Retorna apenas os valores da coluna 'lugar_nmr'
        return $result;
    }
    

    // Cria uma nova reserva
    public function criar($dados)
    {
        try {
            $query = "INSERT INTO reservas (user_id, sessao_id, lugar_nmr, created_at) 
                    VALUES (:user_id, :sessao_id, :lugar_nmr, NOW())";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $dados['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':sessao_id', $dados['sessao_id'], PDO::PARAM_INT);
            $stmt->bindParam(':lugar_nmr', $dados['lugar_nmr'], PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao criar reserva: ' . $e->getMessage());
            throw new Exception('Não foi possível concluir a reserva.');
        }
    }

    // Atualiza uma reserva
    public function atualizar($dados)
    {
        try {
            $query = "UPDATE reservas 
                      SET sessao_id = :sessao_id, lugar_nmr = :lugar_nmr 
                      WHERE id = :id";
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $dados['id'], PDO::PARAM_INT);
            $stmt->bindParam(':sessao_id', $dados['sessao_id'], PDO::PARAM_INT);
            $stmt->bindParam(':lugar_nmr', $dados['lugar_nmr'], PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Erro ao atualizar reserva: ' . $e->getMessage());
            return false;
        }
    }

    // Exclui uma reserva
    public function excluir($id)
    {
        try {
            if (!filter_var($id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID da reserva inválido.');
            }

            $query = "DELETE FROM reservas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log('Erro ao excluir reserva: ' . $e->getMessage());
            return false;
        }
    }

    // Lista reservas por usuário
    public function listarPorUsuario($user_id)
    {
        try {
            if (!filter_var($user_id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID do usuário inválido.');
            }

            $query = "SELECT * FROM reservas WHERE user_id = :user_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao listar reservas por usuário: ' . $e->getMessage());
            return [];
        }
    }

    // Busca reservas por ID
    public function buscarPorId($id)
    {
        try {
            if (!filter_var($id, FILTER_VALIDATE_INT)) {
                throw new InvalidArgumentException('ID da reserva inválido.');
            }

            $query = "SELECT * FROM reservas WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log('Erro ao buscar reserva por ID: ' . $e->getMessage());
            return null;
        }
    }

    

}
?>
