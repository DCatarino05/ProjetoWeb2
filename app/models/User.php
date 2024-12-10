<?php

// Classe User, responsável por realizar operações no banco de dados para manipulação de usuários.
class User
{
    private $db;

    // Construtor da classe, onde a conexão com o banco de dados é inicializada.
    public function __construct()
    {
        // Chama o método Connection::getInstance() para obter a instância da conexão com o banco.
        $this->db = Connection::getInstance();
    }

    // Função para listar todos os users.
    public function listar()
    {
        // Query SQL para selecionar todos os users na tabela "users".
        $query = "SELECT * FROM users";
        // Executa a query no banco de dados.
        $stmt = $this->db->query($query);
        $stmt->execute();
        // Retorna todos os resultados da consulta em formato de array.
        return $stmt->fetchAll();
    }

    // Função para buscar um user pelo ID.
    public function buscarPorId($id)
    {
        // Query SQL para selecionar um user específico pela ID.
        $query = "SELECT * FROM users WHERE id = :id";
        // Prepara a consulta para execução.
        $stmt = $this->db->prepare($query);
        // Associa o parâmetro ':id' com o valor do parâmetro $id.
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Retorna o user correspondente ao ID fornecido (um único resultado).
        return $stmt->fetch();
    }

    // Função para atualizar os dados de um user.
    public function atualizar($dados)
    {
        // Query SQL para atualizar os dados de um user, baseando-se no ID.
        $query = "UPDATE users SET nome = :nome, email = :email, role = :role WHERE id = :id";
        // Prepara a consulta para execução.
        $stmt = $this->db->prepare($query);
        // Executa a consulta com os dados passados como parâmetro.
        return $stmt->execute($dados);
    }

    // Função para excluir um user pelo ID.
    public function excluir($id)
    {
        // Query SQL para excluir um user específico pela ID.
        $query = "DELETE FROM users WHERE id = :id";
        // Prepara a consulta para execução.
        $stmt = $this->db->prepare($query);
        // Associa o parâmetro ':id' com o valor do parâmetro $id.
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Executa a consulta e retorna true ou false com base no sucesso da operação.
        return $stmt->execute();
    }

    // Função para registrar um novo user.
    public function registar($nome, $email, $password)
    {
        // Verifica se o email já está registrado no banco de dados.
        if ($this->buscarPorEmail($email)) {
            // Retorna false se o email já existir.
            return false;
        }
        
        // Query SQL para inserir um novo user na tabela "users".
        $query = "INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)";
        // Prepara a consulta para execução.
        $stmt = $this->db->prepare($query);
        // Associa os parâmetros da consulta com os valores passados.
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        // Executa a consulta e retorna true ou false com base no sucesso da operação.
        return $stmt->execute();
    }

    // Função para buscar um user pelo email.
    public function buscarPorEmail($email)
    {
        // Query SQL para selecionar um user com base no email.
        $query = "SELECT * FROM users WHERE email = :email";
        // Prepara a consulta para execução.
        $stmt = $this->db->prepare($query);
        // Associa o parâmetro ':email' com o valor do parâmetro $email.
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        // Retorna o resultado da busca (um único user) ou false se não encontrar.
        return $stmt->fetch();
    }
}
?>
