<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New User</title>
</head>
<body>
    <?php session_start(); session_destroy(); ?>

    <form action="user_manager.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="user_name" placeholder="Nome" required>
        <input type="email" name="user_email" placeholder="Email" required>
        <input type="password" name="user_password" placeholder="Senha" required>
        <input type="file" name="user-picture">
        
        <button type="submit" name="createNewUser">Criar usuário</button>
    </form>

    
    
</body>
</html>