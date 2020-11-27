<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./partials/menu.css">
    <link rel="stylesheet" href="user_info.css">
    <link rel="stylesheet" href="./errors.css">

    <?php $page_title = 'Minhas informações'; ?>
    <title><?php echo $page_title; ?></title>
</head>
<body>

    <?php
        include_once 'is_logged.php';
        include_once 'errors.php';
        include_once './partials/menu.php';

        $email = $_SESSION['email'];
        $response = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error);

        $infos = $response->fetch_array();
    ?>

    <img src="<?php echo $infos['picture_url']; ?>" alt="User Picture">
    <h3><?php echo $infos['email']; ?></h3>
    
    <form action="user_manager.php" method="POST">
        <input type="text" value="<?php echo $infos['name']; ?>" name="name">
        <input type="password" placeholder="Senha atual" name="current_passwd">
        <input type="password" placeholder="Nova senha" name="new_passwd">
        <input type="password" placeholder="Repita a nova senha" name="confirmation_new_passwd">

        <button type="submit" name="update_user_info">Atualizar meus dados</button>
    </form>

    
    
</body>
</html>