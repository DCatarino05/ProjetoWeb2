<?php
session_start();

require_once __DIR__ . '/config/Connection.php';
require_once __DIR__ . '/app/models/Filme.php';
require_once __DIR__ . '/app/models/Sala.php';
require_once __DIR__ . '/app/models/User.php';
require_once __DIR__ . '/app/models/Sessao.php';
require_once __DIR__ . '/app/models/Reserva.php';

require_once __DIR__ . '/app/controllers/FilmeController.php';
require_once __DIR__ . '/app/controllers/SalasController.php';
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/SessaoController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'User'; // Controlador padrão
$action = isset($_GET['action']) ? $_GET['action'] : 'exibirLogin'; // Ação padrão

// Gerenciamento de rotas
if ($controller === 'Filme') {
    $filmeController = new FilmeController();

    if ($action === 'listar') {
        $filmeController->listar();
    } elseif ($action === 'criar') {
        $filmeController->criar();
    } elseif ($action === 'editar') {
        $filmeController->editar();
    } elseif ($action === 'excluir') {
        $filmeController->excluir();
    } elseif ($action === 'filtrar') {
        $filmeController->filtrar(); 
    }elseif ($action === 'comprar') {
        $filmeController->comprar();
    }
} elseif ($controller === 'Sala') {
    $salaController = new SalaController();

    if ($action === 'listar') {
        $salaController->listar();
    } elseif ($action === 'criar') {
        $salaController->criar();
    } elseif ($action === 'editar') {
        $salaController->editar();
    } elseif ($action === 'excluir') {
        $salaController->excluir();
    }
    
}elseif ($controller === 'Sessao') {
    $sessaoController = new SessaoController();
    if ($action === 'listar') {
        $sessaoController->listar();
    } elseif ($action === 'criar') {
        $sessaoController->criar();
    } elseif ($action === 'editar') {
        $sessaoController->editar();
    } elseif ($action === 'excluir') {
        $sessaoController->excluir();
    }
}elseif ($controller === 'User') {
    $userController = new UserController();

    if ($action === 'login') {
        $userController->login();
    } elseif ($action === 'logout') {
        $userController->logout();
    }elseif ($action === 'exibirLogin') {
        $userController->exibirLogin();
    }elseif ($action === 'exibirRegisto') {
        $userController->exibirRegisto();
    } elseif ($action === 'registar') {
        $userController->registar();
    } elseif ($action === 'painel') {
        $userController->painel(); // Painel de usuário
    } elseif ($action === 'listar') {
        $userController->listar();
    } elseif ($action === 'criar') {
        $userController->criar();
    } elseif ($action === 'editar') {
        $userController->editar();
    } elseif ($action === 'excluir') {
        $userController->excluir();
    }
} else {
    // Caso o controller não exista, redirecione para uma página de erro ou home
    echo "Página não encontrada!";
}
