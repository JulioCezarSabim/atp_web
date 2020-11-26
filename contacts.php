<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./partials/menu.css">
    <link rel="stylesheet" href="./contacts.css">

    <?php $page_title = 'Meus contatos'; ?>
    <title><?php echo $page_title; ?></title>
</head>
<body>

    <?php
        include_once "db_connect.php";
        include_once "is_logged.php";

        include_once "./partials/menu.php";

        $current_user_email = $_SESSION['email'];
        $response = $mysqli->query("SELECT id FROM users WHERE email='$current_user_email'") or die($mysqli->error);
        $current_user_id = $response->fetch_assoc()['id'];
        $contacts = $mysqli->query("SELECT * FROM contacts WHERE users_id='$current_user_id'") or die($mysqli->error);
    ?>

   <div class="main-container">
       <div class="form-container">
            <form action="contacts_manager.php" method="POST" class="form-container--form" enctype="multipart/form-data">
                <input type="text" name="contact-name" placeholder="Nome..." required>
                <input type="text" name="contact-phone" placeholder="(xx) xxxxx-xxxx">
                <input type="file" name="contact-picture">
                <input type="text" name="contact-address" placeholder="Endereço...">

                <button type="submit" name="addContact">Adicionar Contato</button>
            </form>
       </div><!-- insertNewContact-container -->
   
        <div class="contacts-list">

            <?php while ($row = $contacts->fetch_assoc()) : ?>
        
                <div class="contacts-list--item">

                    <a href="#">

                        <div class="contacts-list--item_contactPicture">
                            <img src="./assets/imgs/contacts_pics/<?php echo $row['picture_url'] ?>" alt="Contact Photo">
                        </div><!-- contacts-list--item_contactPicture -->

                        <div class="contacts-list--item_info">
                            <div class="contacts-list--item_info--name"><?php echo $row['name'] ?></div><!-- contacts-list--item_info--name -->
                            <div class="contacts-list--item_info--phone"><?php echo $row['phone']? $row['phone']: ''; ?></div><!-- contacts-list--item_info--phone -->
                            <div class="contacts-list--item_info--address">
                                <?php echo $row['address']? $row['address']: ''; ?>
                            </div><!-- contacts-list--item_info--address -->
                        </div><!-- contacts-list--item_info -->

                    </a>

                    <div class="contacts-list--item_btnDelete">
                        <a href="contacts_manager.php?delete=<?php echo $row['id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div><!-- contacts-list--item_btnDelete -->

                </div><!-- contacts-list--item -->

            <?php endwhile; ?>

        </div><!-- contacts-list -->
   </div><!-- main-container -->

</body>
</html>