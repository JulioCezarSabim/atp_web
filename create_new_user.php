<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="create_new_user.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">

    <?php $page_title = 'Criar conta'; ?>
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <?php session_start(); session_destroy(); ?>

    <div class="main-container">

        <div class="form-container">
            <h1>Criar uma conta</h1>
            <h2>Já possui uma conta? <a href="login.php">Faça login</a></h2>

            <form action="user_manager.php" method="POST" enctype="multipart/form-data">
                <input type="email" name="user_email" placeholder="Email" required>
                <input type="text" name="user_name" placeholder="Nome completo" required>
                <input type="password" name="user_password" placeholder="Senha" required>
                <input type="file" name="user-picture" id="user_picture">
                <label for="user_picture">Selecionar uma foto</label>
                
                <button type="submit" name="createNewUser">Criar conta</button>
            </form>

        </div><!-- form-container -->

    </div><!-- main-container -->

    
    
</body>
</html>