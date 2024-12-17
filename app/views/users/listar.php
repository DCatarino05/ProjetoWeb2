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
        <h2>Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['nome'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                        <a href="index.php?controller=User&action=editar&id=<?= $user['id'] ?>" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="index.php?controller=User&action=excluir&id=<?= $user['id'] ?>" title="Excluir">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; <?= date('Y') ?> Cinemas NOSSO. Todos os direitos reservados.</p>
    </footer>   