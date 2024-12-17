<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detalhes do Filme</title>
  <link rel="stylesheet" href="css/comprar.css">
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

  <div class="lateral" style="background-image: url('<?= htmlspecialchars($filme['cartaz']) ?>');">
    <div class="repeat">
      <a href="#" class="movie-detail__hero__trailer-link">
        ▶
      </a>
    <div class="inferior">
        <div class="movie-banner">
          <img src="<?= htmlspecialchars($filme['cartaz']) ?>" alt="<?= htmlspecialchars($filme['titulo']) ?>" class="poster">
          <div class="details">
            <p class="rating">
              M<?= htmlspecialchars($filme['idademinima']) ?> · <?= htmlspecialchars($filme['categoria']) ?> | 
              <?= sprintf('%02d:%02d', floor($filme['duracao'] / 60), $filme['duracao'] % 60) ?>h
            </p>
            <h1><?= htmlspecialchars($filme['titulo']) ?></h1>
            <p><?= htmlspecialchars($filme['descricao']) ?></p>
          </div>
          <div class="btnsessao">
            <button class="btn-sessions" onclick="scrollToSessoes()" >Ver Sessões</button>
          </div>
        </div>
      
    </div>
    </div>
    
  </div>

  <div class="play-overlay" id="playOverlay">
      <iframe width="80%" height="80%" 
        src="<?= htmlspecialchars($filme['trailer']) ?>" 
        title="YouTube video player" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        referrerpolicy="strict-origin-when-cross-origin" 
        allowfullscreen>
      </iframe>
      <button class="close-btn" onclick="closeVideo()">✖</button>
   
  </div>
  
  <!-- Sessões -->
  <?php if (!empty($sessoes)) : ?>
      <?php foreach ($sessoes as $sessao) : ?>
          <div class="sessao" id="sessao">
              <h1>Sala: <?= htmlspecialchars($sessao['sala_nome'] ?? 'Desconhecida', ENT_QUOTES, 'UTF-8') ?></h1>
              <p>Dia e hora: 
                  <?= htmlspecialchars(date('d/m/Y H:i', strtotime($sessao['dataehora'])), ENT_QUOTES, 'UTF-8') ?>
              </p>
              <p>Preço: <?= htmlspecialchars(number_format($sessao['preco'], 2, ',', '.') . '€') ?></p>
              <a class="comprar" href="index.php?controller=Filme&action=comprar&id=<?= htmlspecialchars($sessao['filme_id'], ENT_QUOTES, 'UTF-8') ?>&sessao_id=<?= htmlspecialchars($sessao['id'], ENT_QUOTES, 'UTF-8') ?>">Comprar Bilhete</a>
          </div>
      <?php endforeach; ?>
  <?php else: ?>
      <h1>Nenhuma sessão encontrada.</h1>
  <?php endif; ?>

  <footer>
    <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
  </footer>

  <script>
    function openVideo() {
      const overlay = document.getElementById('playOverlay');
      overlay.style.display = 'flex';
    }

    function closeVideo() {
  const overlay = document.getElementById('playOverlay');
  const iframe = overlay.querySelector('iframe');
  overlay.style.display = 'none';
  iframe.src = iframe.src; // Reinicia o vídeo
}

    document.querySelector('.movie-detail__hero__trailer-link').addEventListener('click', (e) => {
      e.preventDefault();
      openVideo();
    });

    function scrollToSessoes() {
        const sessaoSection = document.getElementById('sessao');
        if (sessaoSection) {
            sessaoSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
  </script>
  
</body>
</html>
