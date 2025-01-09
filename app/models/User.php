<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function listar()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->query($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserReservations() {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            // Prepara a consulta SQL para pegar as reservas do usuário com informações da sessão, filme e sala
            $query = "
                SELECT 
                    reservas.id AS reserva_id,
                    reservas.lugar_nmr,
                    reservas.created_at AS reserva_data,
                    sessoes.dataehora,
                    filmes.titulo AS filme_titulo,
                    filmes.cartaz AS filme_poster,
                    salas.nome AS sala_nome,
                    users.nome AS user_nome
                FROM reservas
                JOIN sessoes ON reservas.sessao_id = sessoes.id
                JOIN users ON :user_id = users.id
                JOIN filmes ON sessoes.filme_id = filmes.id
                JOIN salas ON sessoes.sala_id = salas.id
                WHERE reservas.user_id = :user_id
            ";
            $stmt = $this->db->prepare($query);
            
            // Liga o parâmetro :user_id à variável
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            
            // Executa a consulta
            $stmt->execute();
            
            // Retorna as reservas com os detalhes da sessão, filme e sala
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // Caso o usuário não esteja logado
            echo "Você precisa estar logado para ver suas reservas.";
            return [];
        }
    }
    
    public function buscarPorId($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function atualizar($dados)
    {
        $query = "UPDATE users SET nome = :nome, email = :email, role = :role WHERE id = :id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($dados);
    }

    public function excluir($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function registar($nome, $email, $password)
    {
        // Verificar se o email já está registrado
        if ($this->buscarPorEmail($email)) {
            return false; // Ou lançar uma exceção se preferir
        }
        
        $query = "INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function buscarPorEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>