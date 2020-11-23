<?php
    include_once 'db_connect.php';
    include 'is_logged.php';

    if (isset($_POST['addContact'])) {
        $name = $_POST['contact-name'];
        $phone = $_POST['contact-phone'];
        $pictureURL = $_POST['contact-pictureUrl'];
        $address = $_POST['contact-address'];

        $current_user_email = $_SESSION['email'];
        $response = $mysqli->query("SELECT id FROM users WHERE email='$current_user_email'") or die($mysqli->error);
        $current_user_id = $response->fetch_assoc()['id'];

        $mysqli->query("INSERT INTO contacts (name, phone, picture_url, address, users_id) VALUES ('$name', '$phone', '$pictureURL', '$address', '$current_user_id')") or die($mysqli->error);

        header("location: contacts.php");
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM contacts WHERE id='$id'");

        header('location: contacts.php');
    }

    