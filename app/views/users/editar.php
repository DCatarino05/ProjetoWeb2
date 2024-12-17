<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar User - Cinema NOSSO</title>
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
        <h2>Editar User</h2>
        <section class="form-section">
        <form method="POST" action="index.php?controller=User&action=editar&id=<?= $user['id'] ?>">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">

            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= $user['nome'] ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>

            <div class="form-group">
                <label for="role">Função:</label>
                <select id="role" name="role" required>
                    <option value="User" <?= $user['role'] === 'User' ? 'selected' : '' ?>>User</option>
                    <option value="Admin" <?= $user['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
                </select>
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
