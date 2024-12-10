<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Cinema NOSSO</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
   
    <form method="POST" action="index.php?controller=User&action=login">
    <h1 class="titulo-logo">
    Cinemas <img src="LogoNosso.png" class="logo" />
    </h1>

    <h2>Login</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Entrar</button>
        
        <p>Não tem uma conta? <a href="index.php?controller=User&action=exibirRegisto">Registar-se</a></p>
    </form>
</body>
</html>
