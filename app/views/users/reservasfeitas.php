<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Filme</title>
  <link rel="stylesheet" href="css/perfil.css">
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
    <h1>Reservas Feitas por <?= htmlspecialchars($reservas[0]['user_nome']) ?></h1>
        <div class="reservas">
            <?php foreach ($reservas as $reserva): ?>
                <div class="reserva">
                    <a >
                        <img class="poster" src="<?= htmlspecialchars($reserva['filme_poster']) ?>" alt="<?= htmlspecialchars($reserva['filme_titulo']) ?>">
                    </a>
                    <br>
                    <a>Dia: <?= htmlspecialchars($reserva['dataehora']) ?></a>
                    <br>
                    <a> <?= htmlspecialchars($reserva['sala_nome']) ?></a>
                    <br>
                    <a>Lugar: <?= htmlspecialchars($reserva['lugar_nmr']) ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
