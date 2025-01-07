<?php

class SessaoController
{
    public function listar()
    {
        $sessaoModel = new Sessao();
        $sessoes = $sessaoModel->listar();
        require_once __DIR__ . '/../views/sessoes/listar.php';
    }

    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':filme_id' => $_POST['filme_id'],
                ':sala_id' => $_POST['sala_id'],
                ':dataehora' => $_POST['dataehora'],
                ':preco' => $_POST['preco']
            ];

            $sessaoModel = new Sessao();
            $sessaoModel->criar($dados);

            header('Location: index.php?controller=Sessao&action=listar');
            exit;
        }

        $filmeModel = new Filme();
        $filmes = $filmeModel->listar();

        $salaModel = new Sala();
        $salas = $salaModel->listar();

        require_once __DIR__ . '/../views/sessoes/criar.php';
    }

    public function editar()
{
    $sessaoModel = new Sessao();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['id'], $_POST['filme_id'], $_POST['sala_id'], $_POST['dataehora'], $_POST['preco'])) {
            $dados = [
                ':id' => $_POST['id'],
                ':filme_id' => $_POST['filme_id'],
                ':sala_id' => $_POST['sala_id'], 
                ':dataehora' => date('Y-m-d H:i:s', strtotime($_POST['dataehora'])),
                ':preco' => $_POST['preco'] 
            ];
            if ($sessaoModel->atualizar($dados)) {
                header('Location: index.php?controller=Sessao&action=listar');
                exit;
            } else {
                echo "Erro ao atualizar a sessão. Por favor, tente novamente.";
            }
        } else {
            echo "Dados inválidos. Certifique-se de preencher todos os campos.";
        }
    }

    $sessao = $sessaoModel->buscarPorId($_GET['id'] ?? null);
    if (!$sessao) {
        echo "Sessão não encontrada.";
        exit;
    }

    $filmeModel = new Filme();
    $filmes = $filmeModel->listar();

    $salaModel = new Sala();
    $salas = $salaModel->listar();

    require_once __DIR__ . '/../views/sessoes/editar.php';
}


    public function excluir()
    {
        $sessaoModel = new Sessao();
        $sessaoModel->excluir($_GET['id']);
        header('Location: index.php?controller=Sessao&action=listar');
        exit;
    }
}
