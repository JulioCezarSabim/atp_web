<?php
    include_once 'db_connect.php';
    include 'is_logged.php';

    if (isset($_POST['addContact'])) {
        $name = $_POST['contact-name'];
        $phone = $_POST['contact-phone'];
        $address = $_POST['contact-address'];

        // Images
        $file = $_FILES['contact-picture'];

        if ($file['size'] == 0) $newFileName = 'default_contact_pic.png';
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
                    $fileDirectory = './assets/imgs/contacts_pics/'.$newFileName;
                    
                    move_uploaded_file($fileTmpName, $fileDirectory);
                }
                else {
                    $_SESSION['show_error'] = 'Um erro ocorreu ao fazer o upload do arquivo';
                    header('location: contacts.php');
                    exit();
                }
            }
            else {
                $_SESSION['show_error'] = 'Você não pode usar esse tipo de arquivo';
                header('location: contacts.php');
                exit();
            }
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
        $mysqli->query("DELETE FROM contacts WHERE id='$id'") or $_SESSION['show_error'] = 'Você não pode apagar um contato que possua empréstimos registrados!';

        header('location: contacts.php');
    }

    