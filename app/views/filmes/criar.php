<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema NOSSO</title>
    <link rel="stylesheet" href="css/style.css">
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
    <h2>Adicionar Filme</h2>
    <section class="form-section">
        <form method="POST" action="index.php?controller=Filme&action=criar">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>

            <div class="form-group">
                <label for="duracao">Duração:</label>
                <input type="time" id="duracao" name="duracao" required>
            </div>

            <div class="form-group">
                <label for="trailer">Trailer (URL):</label>
                <input type="url" id="trailer" name="trailer">
            </div>

            <div class="form-group">
                <label for="cartaz">Cartaz:</label>
                <input type="text" id="cartaz" name="cartaz" required>
            </div>

            <div class="form-group">
                <label for="idade_minima">Idade Mínima:</label>
                <input type="number" id="idade_minima" name="idade_minima" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" required>
            </div>

            <div class="form-group">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </section>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>