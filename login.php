<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">

    <?php $page_title = 'Login'; ?>
    <title><?php echo $page_title; ?></title>
</head>
<body>

    <?php 
        session_start();

        if (isset($_SESSION['is_logged'])) {
            echo 'Usuário ou senha inválidos';
        }
        unset($_SESSION['is_logged']);
    ?>

    <div class="main-container">

        <div class="form-container">
            <h1>Entrar na sua conta</h1>
            <h2>Ainda não possui uma conta? <a href="create_new_user.php">Crie uma</a></h2>

            <form action="login_manager.php" method="POST">
                <input type="text" name="   email" placeholder="Insira seu email" required>
                <input type="password" name="password" placeholder="Insira sua senha" required>

                <button type="submit" name="send">Login</button>
            </form>

        </div><!-- form-container -->

    </div><!-- main-container -->

</body>
</html>