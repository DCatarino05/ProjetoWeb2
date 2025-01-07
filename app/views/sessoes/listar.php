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

    <main>
        <section class="movies">
            <h2>Sessões</h2>
            <div class="actions">
                <a href="index.php?controller=Sessao&action=criar" title="Adicionar Sessão" class="btn">
                    Adicionar Sessão <i class="fas fa-plus"></i>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Filme</th>
                        <th>Data e Hora</th>
                        <th>Sala</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sessoes)) : ?>
                        <?php foreach ($sessoes as $sessao): ?>
                            <tr>
                                <td><?= htmlspecialchars($sessao['filme_nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($sessao['dataehora'])), ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($sessao['sala_nome'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($sessao['preco'], ENT_QUOTES, 'UTF-8') ?>€</td>
                                <td>
                                    <a href="index.php?controller=Sessao&action=editar&id=<?= htmlspecialchars($sessao['id'], ENT_QUOTES, 'UTF-8') ?>" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="index.php?controller=Sessao&action=excluir&id=<?= htmlspecialchars($sessao['id'], ENT_QUOTES, 'UTF-8') ?>" title="Excluir" onclick="return confirm('Tem certeza de que deseja excluir esta sessão?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhuma sessão encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
