<?php

session_start();
include_once 'db_connect.php';

if (isset($_POST['createNewUser'])) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Images
    $file = $_FILES['user-picture'];

    if ($file['size'] == 0) $fileDirectory = './assets/imgs/profile_pics/default_profile_pic.png';
    else {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $tmp = explode('.', $fileName);
        $fileExtension = strtolower(end($tmp));
        $extensionsAllowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileExtension, $extensionsAllowed)) {
            if ($fileError === 0) {
                $newFileName = uniqid('', true).".".$fileExtension;
                $fileDirectory = './assets/imgs/profile_pics/'.$newFileName;
                
                move_uploaded_file($fileTmpName, $fileDirectory);
            }
            else {
                echo 'Um erro ocorreu ao fazer o upload do arquivo';
            }
        }
        else {
            echo 'Você não pode usar esse tipo de arquivo';
        }
    }

    $mysqli->query("INSERT INTO users (name, email, password, picture_url) VALUES ('$name', '$email', md5('$password'), '$fileDirectory')") or die($mysqli->error);

    header("location: login.php");
}

if (isset($_POST['update_user_info'])) {
    
    $email = $_SESSION['email'];
    $name = $_POST['name'];
    $current_passwd = $_POST['current_passwd'];
    $new_passwd = $_POST['new_passwd'];
    $confirmation_new_passwd = $_POST['confirmation_new_passwd'];

    if ($current_passwd || $new_passwd || $confirmation_new_passwd) {
        if (!$current_passwd || !$new_passwd || !$confirmation_new_passwd) {
            if (!$current_passwd) $_SESSION['show_error'] = 'Você precisa inserir sua senha atual';
            if (!$new_passwd) $_SESSION['show_error'] = 'Você precisa inserir uma nova senha';
            if (!$confirmation_new_passwd) $_SESSION['show_error'] = 'Você precisa confirmar sua nova senha';

            header('location: user_info.php');
        }

        if ($current_passwd && $new_passwd && $confirmation_new_passwd) {
            $response = $mysqli->query("SELECT password FROM users WHERE email='$email'") or die($mysqli->error);
            $user_passwd = $response->fetch_assoc()['password'];

            if (md5($current_passwd) == $user_passwd) {
                if ($new_passwd == $confirmation_new_passwd) {
                    $mysqli->query("UPDATE users SET password=md5('$new_passwd') WHERE email='$email'") or die($mysqli->error);
                }
                else {
                    $_SESSION['show_error'] = 'A confirmação de senha está diferente da nova senha';
                    header('location: user_info.php');
                }
            }
            else {
                $_SESSION['show_error'] = 'A senha atual inserida está incorreta';
                header('location: user_info.php');
            }
        }
    }

    $mysqli->query("UPDATE users SET name='$name' WHERE email='$email'") or die($mysqli->error);
}