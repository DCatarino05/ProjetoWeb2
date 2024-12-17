<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Filme</title>
  <link rel="stylesheet" href="css/reservar.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1 class="titulo-logo">
              <a class="titulo-logo" href="index.php?controller=Filme&action=listar">
                Cinemas <img src="LogoNosso.png" class="logonosso" />
              </a>
            </h1>     
        </div>
        <ul class="nav-links">
            <li class="logout">
            <a href="index.php?controller=User&action=logout" title="Sair da conta" class="btn-logout">
                Logout <i class="fas fa-sign-out-alt"></i>
            </a>
            </li>
        </ul>
    </header>
    <div class="container">
        <div class="filme">
        <img src="<?= htmlspecialchars($filme['cartaz']) ?>" alt="<?= htmlspecialchars($filme['titulo']) ?>" class="poster">
        </div>
        <div class="sala">
            <h1>Selecionar Lugares para o Filme: <?= htmlspecialchars($filme['titulo']) ?></h1>
            <h2>Sessão: <?= date('d/m/Y H:i', strtotime($sessao['dataehora'])) ?></h2>
            <div class="dentosala">
                <div class="tela-de-cinema">
                    Ecrã
                </div>
                <form action="index.php?controller=Filme&action=processarReserva" method="post" class="filas">
                    <input type="hidden" name="sessao_id" value="<?= $sessao_id ?>">
                    <?php foreach ($filas as $index => $fila): ?>
                        <div class="fila">
                            <?php  foreach ($fila as $lugar): ?>
                                <label class="lugar <?= $lugar['reservado'] ? 'reservado' : 'disponivel' ?>">
                                        <input type="checkbox" name="lugares[]" value="<?= htmlspecialchars($lugar['numero']) ?>">
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <button class="btn-confirm" type="submit">CONFIRMAR RESERVA</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
