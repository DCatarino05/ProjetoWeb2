<?php

// Controlador responsável pelas ações relacionadas aos users.
class UserController
{
    // Função para listar todos os users.
    public function listar()
    {
        // Cria uma instância do modelo User.
        $userModel = new User();
        // Chama a função listar() do modelo para obter todos os users.
        $users = $userModel->listar();
        // Inclui a visão para exibir a lista de users.
        require_once __DIR__ . '/../views/users/listar.php';
    }

    // Função para editar os dados de um user.
    public function editar()
    {
        // Cria uma instância do modelo User.
        $userModel = new User();
        
        // Verifica se a requisição é do tipo POST (formulário enviado).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Prepara os dados para atualização.
            $dados = [
                ':id' => $_POST['id'],
                ':nome' => $_POST['nome'],
                ':email' => $_POST['email'],
                ':role' => $_POST['role'],
            ];
            // Chama a função atualizar() do modelo para atualizar os dados do user.
            $userModel->atualizar($dados);
            // Redireciona para a lista de users após a atualização.
            header('Location: index.php?controller=User&action=listar');
            exit;
        }

        // Se não for POST, busca o users com o ID fornecido.
        $user = $userModel->buscarPorId($_GET['id']);
        // Exibe a visão para editar os dados do users.
        require_once __DIR__ . '/../views/users/editar.php';
    }

    // Função para excluir um users.
    public function excluir()
    {
        // Cria uma instância do modelo User.
        $userModel = new User();
        // Exclui o users com o ID fornecido na URL.
        $userModel->excluir($_GET['id']);
        // Redireciona de volta para a lista de users.
        header('Location:   index.php?controller=User&action=listar');
    }

    // Função para exibir o formulário de registro de um novo users.
    public function exibirRegisto()
    {
        // Exibe a visão para o formulário de registro de users.
        require_once __DIR__ . '/../views/users/Register.php';
    }

    // Função para registrar um novo users.
    public function registar()
    {
        // Verifica se a requisição é do tipo POST (formulário enviado).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtém os dados do formulário.
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password']; 

            // Cria uma instância do modelo User.
            $userModel = new User();
            // Chama a função registar() do modelo para registrar o users.
            if ($userModel->registar($nome, $email, $password)) {
                // Redireciona para a tela de login após o sucesso no registro.
                header('Location: index.php?controller=User&action=exibirLogin');
                exit;
            } else {
                // Exibe uma mensagem de erro se o registro falhar.
                echo "Erro ao registar users.";
            }
        }
    }

    // Função para exibir o formulário de login.
    public function exibirLogin()
    {
        // Exibe a visão para o formulário de login.
        require_once __DIR__ . '/../views/users/Login.php';
    }

    // Função para realizar o login de um users.
    public function login()
    {
        // Verifica se a requisição é do tipo POST (formulário enviado).
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se os campos de email e senha estão preenchidos.
            if (isset($_POST['email']) && isset($_POST['password'])) {
                // Obtém os dados do formulário.
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                // Cria uma instância do modelo User.
                $userModel = new User();
                // Busca o users pelo email fornecido.
                $user = $userModel->buscarPorEmail($email);
    
                // Verifica se a senha fornecida é correta.
                if ($password === $user['password']) {
                    // Inicia uma sessão e armazena os dados do users.
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_nome'] = $user['nome'];
                    $_SESSION['user_role'] = $user['role'];
                    // Redireciona o users para a lista de filmes.
                    header('Location: index.php?controller=Filme&action=listar'); 
                    exit;
                } else {
                    // Exibe uma mensagem de erro se o email ou senha estiverem incorretos.
                    echo "Email ou senha incorretos.";
                }
            } else {
                // Exibe uma mensagem se os campos não forem preenchidos.
                echo "Por favor, preencha todos os campos.";
            }
        }
    }

    // Função para realizar o logout do users.
    public function logout()
    {
        // Inicia a sessão e destrói os dados da sessão.
        session_start();
        session_destroy();
        // Redireciona para a página inicial após o logout.
        header('Location: index.php');
    }
}
?>
