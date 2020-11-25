<?php
    include_once 'db_connect.php';
    include 'is_logged.php';

    if (isset($_POST['addContact'])) {
        $name = $_POST['contact-name'];
        $phone = $_POST['contact-phone'];
        $address = $_POST['contact-address'];

        // Images
        $file = $_FILES['contact-picture'];
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
                $fileDirectory = './assets/imgs/contacts_pics/'.$newFileName;
                
                move_uploaded_file($fileTmpName, $fileDirectory);
            }
            else {
                echo 'Um erro ocorreu ao fazer o upload do arquivo';
            }
        }
        else {
            echo 'Você não pode usar esse tipo de arquivo';
        }

        //Queries
        $current_user_email = $_SESSION['email'];
        $response = $mysqli->query("SELECT id FROM users WHERE email='$current_user_email'") or die($mysqli->error);
        $current_user_id = $response->fetch_assoc()['id'];

        $mysqli->query("INSERT INTO contacts (name, phone, picture_url, address, users_id) VALUES ('$name', '$phone', '$newFileName', '$address', '$current_user_id')") or die($mysqli->error);

        header("location: contacts.php");
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM contacts WHERE id='$id'");

        header('location: contacts.php');
    }

    