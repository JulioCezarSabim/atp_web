<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
</head>
<body>

    <?php 
        session_start();
        if (isset($_SESSION['is_logged'])) {
            echo 'Usuário ou senha inválidos';
        }
        unset($_SESSION['is_logged']);
    ?>

    <form action="login.php" method="POST">
        <input type="text" name="email" placeholder="Insira seu email" required>
        <input type="password" name="password" placeholder="Insira sua senha" required>

        <button type="submit" name="send">Login</button>
    </form>

</body>
</html>