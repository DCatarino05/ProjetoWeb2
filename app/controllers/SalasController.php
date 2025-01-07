<?php

class SalaController
{
    public function listar()
    {
        $salaModel = new Sala();
        $salas = $salaModel->listar();
        require_once __DIR__ . '/../views/salas/listar.php';
    }

    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':nome' => $_POST['nome'],
                ':capacidade' => $_POST['capacidade']
            ];

            $salaModel = new Sala();
            $salaModel->criar($dados);

            header('Location: index.php?controller=Sala&action=listar');
            exit;
        }
        require_once __DIR__ . '/../views/salas/criar.php';
    }

    public function editar()
    {
        $salaModel = new Sala();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                ':id' => $_POST['id'],
                ':nome' => $_POST['nome'],
                ':capacidade' => $_POST['capacidade']
            ];
            $salaModel->atualizar($dados);
            header('Location: index.php?controller=Sala&action=listar');
            exit;
        }

        $sala = $salaModel->buscarPorId($_GET['id']);
        require_once __DIR__ . '/../views/salas/editar.php';
    }

    public function excluir()
    {
        $salaModel = new Sala();
        $salaModel->excluir($_GET['id']);
        header('Location:   index.php?controller=Sala&action=listar');
    }
}
