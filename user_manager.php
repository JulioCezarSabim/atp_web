<?php

include_once 'db_connect.php';

if (isset($_POST['createNewUser'])) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    // Images
    $file = $_FILES['user-picture'];
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


    $mysqli->query("INSERT INTO users (name, email, password, picture_url) VALUES ('$name', '$email', md5('$password'), '$fileDirectory')") or die($mysqli->error);

    header("location: login.php");
}