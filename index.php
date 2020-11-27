<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="./partials/menu.css">

    <?php $page_title = 'Meus empréstimos'; ?>
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <?php
        include_once 'db_connect.php';
        include_once 'is_logged.php';
        include_once './partials/menu.php';
        require_once 'items_manager.php';

        $current_user_email = $_SESSION['email'];
        $response = $mysqli->query("SELECT id FROM users WHERE email='$current_user_email'") or die($mysqli->error);
        $current_user_id = $response->fetch_assoc()['id'];
        $items = $mysqli->query("SELECT * FROM items WHERE users_id='$current_user_id'") or die($mysqli->error);

        $contacts = $mysqli->query("SELECT * FROM contacts WHERE users_id='$current_user_id'") or die($mysqli->error);
    ?>

    <div class="main-container">

        <div class="form-container">
            <div class="form-container--contacts">
                <span><i class="fas fa-chevron-down"></i><span>Contato para empréstimo</span></span>
                <div class="form-container--contacts_list">

                    <?php while ($row = $contacts->fetch_assoc()) : ?>
                        <a href="index.php?selected_contact=<?php echo $row['id'] ?>">
                            <div class="form-container--contacts_list--contact">
                                <div class="form-container--contacts_list--contact_image">
                                    <img src="./assets/imgs/contacts_pics/<?php echo $row['picture_url'] ?>" alt="Contact Picture">
                                </div><!-- form-container--contacts_contact--image -->
                                <div class="form-container--contacts_list--contact_name">
                                    <?php echo $row['name'] ?>
                                </div><!-- form-container--contacts_contact--name -->
                            </div><!-- form-container--contacts_contact -->
                        </a>
                    <?php endwhile; ?>

                </div><!-- form-container--contacts_list -->
            </div><!-- form-container--contacts -->

            <form action="./items_manager.php" method="POST" class="form-container--form">
                <input type="text" name="description" placeholder="Descrição do Item..." id="description" required>
                <input type="date" name="date_lended" value="<?php echo date('Y-m-d'); ?>" required>
                <input type="date" name="date_return">
                <input type="hidden" name="selected_contact" value="<?php echo $selected_contact; ?>">

                <button type="submit" name="addItem">Cadastrar</button>
            </form>
        </div><!-- form-container -->

        <div class="items-container">

            <?php while ($row = $items->fetch_assoc()) : ?>
            
                <div class="items-container--item <?php if (!$row['date_return'] || $row['date_return'] < date('Y-m-d')) echo 'highlighted'; ?>">
                    <div class="items-container--item_content">
                        <div class="top">
                            <?php
                                if ($row['date_return'] == NULL || $row['date_return'] < date('Y-m-d')) {
                                    if ($row['finished'] != 1) echo '<i class="fas fa-exclamation-circle"></i>';
                                }
                            ?>
                            <?php
                                $description = $row['description'];
                                echo !$row['finished'] ? $row['description'] : "<s>$description</s>"
                            ?>
                        </div><!-- top -->

                        <div class="bottom">
                            <div class="left">
                                <a href="#">
                                    <?php 
                                        $contact_id = $row['contacts_id'];
                                        $response = $mysqli->query("SELECT picture_url FROM contacts WHERE id='$contact_id'") or die($mysqli->error);
                                        $picture_url = $response->fetch_assoc()['picture_url'];
                                    ?>
                                    <img src="./assets/imgs/contacts_pics/<?php echo $picture_url; ?>" alt="Contacts Picture">
                                </a>
                            </div><!-- right -->

                            <div class="right">
                                <span class="date_lended">
                                    <span>Data de empréstimo: </span>
                                    <?php echo $row['date_lended']; ?>
                                </span>

                                <span class="date_return" id="date_return">
                                    <span>Data de devolução: </span>
                                    <?php echo $row['date_return'] ? $row['date_return'] : 'Em aberto'; ?>
                                </span>
                            </div><!-- left -->
                        </div><!-- bottom -->
                    </div><!-- items-container--item_content -->

                    <div class="items-container--item_actions">
                        <a href="items_manager.php?finished=<?php echo $row['id']; ?>">
                            <i class="far fa-check-circle <?php echo $row['finished'] ? 'item_finished' : ''; ?>"></i>
                        </a>
                        <a href="items_manager.php?delete=<?php echo $row['id'] ?>">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div><!-- contacts-list--item_btnDelete -->
                </div><!-- items-container--item -->
            
            <?php endwhile; ?>

        </div><!-- items-container -->

    </div><!-- main-container -->

</body>
</html>