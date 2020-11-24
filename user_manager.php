<?php

include_once 'db_connect.php';

if (isset($_POST['createNewUser'])) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $password = $_POST['user_password'];

    $mysqli->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', md5('$password'))") or die($mysqli->error);

    header("location: login.php");
}