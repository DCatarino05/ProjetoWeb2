<?php

class UserController
{
    public function listar()
    {
        $userModel = new User();
        $users = $userModel->listar();
        require_once __DIR__ . '/../views/users/listar.php';
    }

    public function perfil()
    {
        $userModel = new User();
        $reservas = $userModel->getUserReservations();
        require_once __DIR__ . '/../views/users/reservasfeitas.php';
    }

    public function editar()
    {
        $userModel = new User();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':id' => $_POST['id'],
                ':nome' => $_POST['nome'],
                ':email' => $_POST['email'],
                ':role' => $_POST['role'],

            ];
            $userModel->atualizar($dados);
            header('Location: index.php?controller=User&action=listar');
            exit;
        }

        $user = $userModel->buscarPorId($_GET['id']);
        require_once __DIR__ . '/../views/users/editar.php';
    }

    public function excluir()
    {
        $userModel = new User();
        $userModel->excluir($_GET['id']);
        header('Location:   index.php?controller=User&action=listar');
    }



    public function exibirRegisto()
    {
        require_once __DIR__ . '/../views/users/Register.php';
    }

    public function registar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $password = $_POST['password']; 

            $userModel = new User();
            $user = $userModel;
            if ($user->registar($nome, $email, $password)) {
                header('Location: index.php?controller=User&action=exibirLogin');
                exit;
            } else {
                echo "Erro ao registar usuário.";
            }
        }
    }


    public function exibirLogin()
    {
        require_once __DIR__ . '/../views/users/Login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
    
                $userModel = new User();
                $user = $userModel->buscarPorEmail($email);
    
                if ($password === $user['password']) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_nome'] = $user['nome'];
                    $_SESSION['user_role'] = $user['role'];
                    header('Location: index.php?controller=Filme&action=listar'); 
                    exit;
                } else {
                    echo "Email ou senha incorretos.";
                }
            } else {
                echo "Por favor, preencha todos os campos.";
            }
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: index.php');
    }
}
?>