<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sessão - Cinema NOSSO</title>
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
        <h2>Editar Sessão</h2>
        <section class="form-section">
        <form method="POST" action="index.php?controller=Sessao&action=editar&id=<?= $sessao['id'] ?>">
            <input type="hidden" name="id" value="<?= $sessao['id'] ?>">

            <div class="form-group">
                <label for="filme">Filme:</label>
                <select id="filme" name="filme_id" required>
                    <?php foreach ($filmes as $filme): ?>
                        <option value="<?= $filme['id'] ?>" <?= $sessao['filme_id'] == $filme['id'] ? 'selected' : '' ?>>
                            <?= $filme['titulo'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="sala">Sala:</label>
                <select id="sala" name="sala_id" required>
                    <?php foreach ($salas as $sala): ?>
                        <option value="<?= $sala['id'] ?>" <?= $sessao['sala_id'] == $sala['id'] ? 'selected' : '' ?>>
                            <?= $sala['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="data_hora">Data e Hora:</label>
                <input type="datetime-local" id="data_hora" name="dataehora" value="<?= date('Y-m-d\TH:i', strtotime($sessao['dataehora'])) ?>" required>
            </div>

            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" value="<?= $sessao['preco'] ?>" required>
            </div>


            <div class="form-group">
                <button type="submit">Salvar Alterações</button>
            </div>
        </form>

        </section>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
