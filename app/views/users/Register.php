<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Registar - Cinema NOSSO</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form method="POST" action="index.php?controller=User&action=registar">
        <h1 class="titulo-logo">
            Cinemas <img src="LogoNosso.png" class="logo" />
        </h1>
        <h2>Register</h2>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Criar</button>

        <p>Já tem uma conta? <a href="index.php?controller=User&action=exibirLogin">Faça Login</a></p>
    </form>
</body>
</html>
