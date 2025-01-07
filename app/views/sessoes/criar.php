<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema NOSSO - Criar Sessão</title>
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

    <main>
        <section class="movies">
            <h2>Adicionar Sessão</h2>
            <section class="form-section">
                <form method="POST" action="index.php?controller=Sessao&action=criar">
                    <label for="filme_id">Filme:</label>
                    <select name="filme_id" id="filme_id" required>
                        <option value="">Selecione um filme</option>
                        <?php foreach ($filmes as $filme): ?>
                            <option value="<?= htmlspecialchars($filme['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($filme['titulo'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="sala_id">Sala:</label>
                    <select name="sala_id" id="sala_id" required>
                        <option value="">Selecione uma sala</option>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= htmlspecialchars($sala['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($sala['nome'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="dataehora">Data e Hora:</label>
                    <input type="datetime-local" name="dataehora" id="dataehora" required>

                    
                    <label for="preco">Preço:</label>
                    <span>€</span>
                    <input type="number" name="preco" id="preco" step="0.01" min="0" required>
                    


                    <button type="submit">Salvar</button>
                </form>
            </section>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
