<?php
    include_once 'db_connect.php';
    session_start();

    if ($_POST['email'] == NULL || $_POST['password'] == NULL) {
        header("Location: login.php");
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $mysqli->query("SELECT name, email FROM users WHERE email='$email' AND password=md5('$password')") or die($mysqli->error);

    if ($result->num_rows == 1) {
        $user_info = $result->fetch_assoc();
        
        $_SESSION['name'] = $user_info['name'];
        $_SESSION['email'] = $user_info['email'];

        header("location: index.php");
    }
    else {
        $_SESSION['is_logged'] = false;
        header("location: login.php");
        exit();
    }