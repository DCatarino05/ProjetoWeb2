<?php

class FilmeController
{
    // Lista todos os filmes
    public function listar()
    {
        $filmeModel = new Filme();
        $filmes = $filmeModel->listar();
        $categorias = $filmeModel->listarCategorias();
        require_once __DIR__ . '/../views/filmes/listar.php';
    }


    // Cria um novo filme
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se o token CSRF é válido
            if (!$this->validarTokenCSRF($_POST['csrf_token'])) {
                die('Token CSRF inválido!');
            }

            // Validação e sanitização dos dados
            $duracao = $_POST['duracao']; 
            $duracaoParts = explode(':', $duracao); 
            $duracaoMinutos = ($duracaoParts[0] * 60) + $duracaoParts[1];

            // Montar dados para o modelo
            $dados = [
                ':titulo' => htmlspecialchars($_POST['titulo']),
                ':descricao' => htmlspecialchars($_POST['descricao']),
                ':duracao' => $duracaoMinutos, 
                ':trailer' => htmlspecialchars($_POST['trailer']),
                ':cartaz' => htmlspecialchars($_POST['cartaz']),
                ':idade_minima' => intval($_POST['idade_minima']),
                ':categoria' => htmlspecialchars($_POST['categoria'])
            ];

            $filmeModel = new Filme();
            $filmeModel->criar($dados);

            // Redirecionar para a lista de filmes após criar
            header('Location: index.php?controller=Filme&action=listar');
            exit;
        }

        // Gera um novo token CSRF
        $csrf_token = $this->gerarTokenCSRF();
        require_once __DIR__ . '/../views/filmes/criar.php';
    }

    // Edita um filme existente
    public function editar()
    {
        $filmeModel = new Filme();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifica se o token CSRF é válido
            if (!$this->validarTokenCSRF($_POST['csrf_token'])) {
                die('Token CSRF inválido!');
            }

            // Validação e sanitização dos dados
            $duracao = $_POST['duracao'];
            list($horas, $minutos) = explode(':', $duracao);
            $duracaoEmMinutos = ($horas * 60) + $minutos;

            // Dados a serem atualizados
            $dados = [
                ':id' => $_POST['id'],
                ':titulo' => htmlspecialchars($_POST['titulo']),
                ':descricao' => htmlspecialchars($_POST['descricao']),
                ':duracao' => $duracaoEmMinutos,
                ':trailer' => htmlspecialchars($_POST['trailer']),
                ':cartaz' => htmlspecialchars($_POST['cartaz']),
                ':idade_minima' => intval($_POST['idade_minima']),
                ':categoria' => htmlspecialchars($_POST['categoria'])
            ];

            // Atualiza os dados no banco
            $filmeModel->atualizar($dados);

            // Redireciona para a lista de filmes após a atualização
            header('Location: index.php?controller=Filme&action=listar');
            exit;
        }

        // Carrega os dados do filme para edição
        $filme = $filmeModel->buscarPorId($_GET['id']);
        $filme['duracao'] = sprintf('%02d:%02d', floor($filme['duracao'] / 60), $filme['duracao'] % 60);

        // Gera um novo token CSRF
        $csrf_token = $this->gerarTokenCSRF();

        require_once __DIR__ . '/../views/filmes/editar.php';
    }

    // Exclui um filme
    public function excluir()
    {
        // Verifica se o ID é válido e se o usuário está autenticado
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            die('ID inválido!');
        }

        // Verifica se o token CSRF é válido
        if (!$this->validarTokenCSRF($_GET['csrf_token'])) {
            die('Token CSRF inválido!');
        }

        $filmeModel = new Filme();
        $filmeModel->excluir($_GET['id']);
        
        header('Location: index.php?controller=Filme&action=listar');
        exit;
    }

    // Comprar ingressos para um filme
    public function comprar()
    {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $filmeModel = new Filme();
            $sessaoModel = new Sessao();
            $salaModel = new Sala();
            $reservaModel = new Reserva();

            $filme = $filmeModel->buscarPorId($_GET['id']);
            $sessoes = $sessaoModel->buscarPorIdFilme($_GET['id']);

            if (isset($_GET['sessao_id']) && is_numeric($_GET['sessao_id'])) {
                $sessao_id = $_GET['sessao_id'];
                $sessao = $sessaoModel->buscarPorId($sessao_id);
                $sala = $salaModel->buscarPorId($sessao['sala_id']);
                $lugaresReservados = $reservaModel->buscarPorSessaoLugar($sessao_id);

                $capacidade = $sala['capacidade'];
                $lugares_por_fila = 15;
                $filas = [];
                $total_lugares = $capacidade;
                $numero_lugar = 1;

                while ($total_lugares > 0) {
                    $fila = [];
                    for ($i = 0; $i < $lugares_por_fila && $total_lugares > 0; $i++) {
                        $fila[] = [
                            'numero' => $numero_lugar,
                            'reservado' => in_array($numero_lugar, $lugaresReservados),
                        ];
                        $numero_lugar++;
                        $total_lugares--;
                    }
                    $filas[] = $fila;
                }
                require_once __DIR__ . '/../views/filmes/reservar.php';
                return;
            }

            require_once __DIR__ . '/../views/filmes/comprar.php';
        } else {
            header('Location: index.php?controller=Filme&action=listar');
            exit;
        }
    }

    // Filtra filmes por categoria
    public function filtrar()
    {
        $filmeModel = new Filme();
        
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : '';
        
        
        // Filtra filmes por categoria ou título
        if ($categoria) {
            $filmes = $filmeModel->filtrar($categoria);
        } else {
            // Exibe todos os filmes (sem filtro de categoria)
            $filmes = $filmeModel->listar();
        }

        // Obtém as categorias para exibição no filtro
        $categorias = $filmeModel->listarCategorias(); 

        require_once __DIR__ . '/../views/filmes/listar.php';
    }

    // Gera um token CSRF
    private function gerarTokenCSRF()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Gera um token aleatório
        }
        return $_SESSION['csrf_token'];
    }

    // Valida um token CSRF
    private function validarTokenCSRF($token)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($token) && $token === $_SESSION['csrf_token'];
    }

    public function processarReserva()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_start();
        $reservaModel = new Reserva();
        $sessaoModel = new Sessao();

        $user_id = $_SESSION['user_id']; // Assumindo que o ID do usuário está na sessão
        $sessao_id = intval($_POST['sessao_id']);
        $lugares = $_POST['lugares'] ?? [];

        if (empty($lugares)) {
            die('Nenhum lugar selecionado.');
        }

        // Verificar se os lugares ainda estão disponíveis
        $lugaresReservados = array_column($reservaModel->buscarPorSessao($sessao_id), 'lugar_nmr');
        foreach ($lugares as $lugar) {
            if (in_array($lugar, $lugaresReservados)) {
                die("O lugar {$lugar} já foi reservado. Por favor, escolha outro.");
            }
        }

        // Criar reservas
        foreach ($lugares as $lugar) {
            $reservaModel->criar([
                'user_id' => $user_id,
                'sessao_id' => $sessao_id,
                'lugar_nmr' => intval($lugar),
            ]);
        }

        // Redirecionar com mensagem de sucesso
        header('Location: index.php?controller=Filme&action=listar&msg=Reserva realizada com sucesso');
        exit;
    }
}


}



