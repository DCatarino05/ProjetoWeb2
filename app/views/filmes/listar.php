<?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema NOSSO - Admin</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<!-- Cabeçalho -->
<header class="header">
    <div class="logo">
        <h1 class="titulo-logo">
            <a class="titulo-logo" href="index.php?controller=Filme&action=listar">
            Cinemas <img src="LogoNosso.png" class="logonosso" />
            </a>
        </h1>    
    </div>

    <ul class="nav-links">
        <li><a href="index.php?controller=Filme&action=listar">Filmes</a></li>
        <li><a href="index.php?controller=Sala&action=listar">Salas</a></li>
        <li><a href="index.php?controller=Sessao&action=listar">Sessões</a></li>
        <li><a href="index.php?controller=User&action=listar">Users</a></li>
        <li class="logout">
            <a href="index.php?controller=User&action=logout" class="btn-logout" title="Sair da conta">
                Logout <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</header>

<section class="movies">
    <h2>Filmes em cartaz</h2>
    <div class="actions">
        <a href="index.php?controller=Filme&action=criar" class="btn" title="Adicionar Filme">
            Adicionar Filme <i class="fas fa-plus"></i>
        </a>
    </div>
    <div class="movies-grid">
        <?php foreach ($filmes as $filme): ?>
            <div class="movie-card">
                <img src="<?= htmlspecialchars($filme['cartaz']) ?>" alt="<?= htmlspecialchars($filme['titulo']) ?>">
                <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
                <a href="index.php?controller=Filme&action=editar&id=<?= urlencode($filme['id']) ?>" title="Editar Filme">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="index.php?controller=Filme&action=excluir&id=<?= urlencode($filme['id']) ?>" title="Excluir Filme" 
                   onclick="return confirm('Tem certeza de que deseja excluir este filme?');">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php elseif (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user'): ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema NOSSO</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<!-- Cabeçalho -->
<header class="header">
    <div class="logo">
        <h1 class="titulo-logo">
            <a class="titulo-logo" href="index.php?controller=Filme&action=listar">
            Cinemas <img src="LogoNosso.png" class="logonosso" />
            </a>
        </h1>    
    </div>

    <div class="search">
        <form action="index.php?controller=Filme&action=pesquisar" method="GET">
            <input type="text" name="query" placeholder="Pesquise por filmes" required>
            <button type="submit">&#128269;</button>
        </form>
    </div>

    <ul class="nav-links">
    <li class="logout">
            <a href="index.php?controller=User&action=perfil" class="btn-peril" title="Perfil">
                Perfil 
            </a>
        </li>
        <li class="logout">
            <a href="index.php?controller=User&action=logout" class="btn-logout" title="Sair da conta">
                Logout <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</header>

<section class="movies">
    <h2>Filmes em cartaz</h2>

    <div class="filter">
    <form class="filter-form" action="index.php?controller=Filme&action=filtrar" method="POST">
        <label for="categoria">Filtrar por Categoria:</label>
        <select name="categoria" id="categoria">
            <option value="">Todas</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= htmlspecialchars($categoria['categoria']) ?>" 
                    <?= isset($_POST['categoria']) && $_POST['categoria'] == $categoria['categoria'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($categoria['categoria']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="filter-btn">Filtrar</button>
    </form>

    </div>

    <div class="movies-grid">
        <?php foreach ($filmes as $filme): ?>
            <a class="movie-card" href="index.php?controller=Filme&action=comprar&id=<?= urlencode($filme['id']) ?>">
                <img src="<?= htmlspecialchars($filme['cartaz']) ?>" alt="<?= htmlspecialchars($filme['titulo']) ?>">
                <h3><?= htmlspecialchars($filme['titulo']) ?></h3>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<?php else: ?>
<p>Por favor, faça login para acessar o conteúdo.</p>
<?php endif; ?>

<footer>
    <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
</footer>
</body>
</html>
