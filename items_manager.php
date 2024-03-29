<?php
include_once 'db_connect.php';
include_once 'is_logged.php';

$selected_contact = null;

if (isset($_POST['addItem'])) {

    if ($_POST['selected_contact']) {
        $user_email = $_SESSION['email'];
        $response = $mysqli->query("SELECT id FROM users WHERE email='$user_email'") or die($mysqli->error);
    
        $user_id = $response->fetch_assoc()['id'];
        $contact_id = $_POST['selected_contact'];
        $description = $_POST['description'];
        $date_lended = $_POST['date_lended'];
        $date_return = $_POST['date_return'];
    
        if ($date_return == NULL) {
            $mysqli->query("INSERT INTO items (description, date_lended, contacts_id, users_id) VALUES ('$description', '$date_lended', '$contact_id', '$user_id')") or die($mysqli->error);
        }
        else {
            $mysqli->query("INSERT INTO items (description, date_lended, date_return, contacts_id, users_id) VALUES ('$description', '$date_lended', '$date_return', '$contact_id', '$user_id')") or die($mysqli->error);
        }
    }
    else {
        $_SESSION['show_error'] = 'Você precisa selecionar um contato!';
    }

    header('location: index.php');
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM items WHERE id='$id'");

    header('location: index.php');
}

if (isset($_GET['selected_contact'])) {
    $selected_contact = $_GET['selected_contact'];
}

if (isset($_GET['finished'])) {
    $id = $_GET['finished'];

    $response = $mysqli->query("SELECT finished FROM items WHERE id=$id") or die($mysqli->error);
    $finished = $response->fetch_assoc()['finished'];
    $current_date = date('Y-m-d');

    if ($finished) $mysqli->query("UPDATE items SET finished=NULL, date_returned=NULL WHERE id='$id'") or die($mysqli->error);
    else $mysqli->query("UPDATE items SET finished=1, date_returned='$current_date' WHERE id='$id'") or die($mysqli->error);

    header('location: index.php');
}