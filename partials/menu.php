<?php
    include_once 'db_connect.php';
    
    $user_email = $_SESSION['email'];
    $user_picture = $mysqli->query("SELECT picture_url FROM users WHERE email='$user_email'") or die($mysqli->error);
?>

<nav class="menu">
    <div class="page-title"><?php echo $page_title; ?></div><!-- page_title -->

    <ul class="menu--list">
        <li class="menu--list_item">
            <a href="./index.php"><i class="fas fa-home"></i></a>
        </li><!-- menu-list--item -->

        <li class="menu--list_item">
            <a href="./contacts.php"><i class="fas fa-address-book"></i></a>
        </li><!-- menu-list--item -->

        <li class="menu--list_item">
            <a href="my_info"><i class="fas fa-user"></i></a>
        </li><!-- menu-list--item -->

        <li class="menu--list_item">
            <a href="./logout.php"><i class="fas fa-door-open"></i></a>
        </li><!-- menu-list--item -->

        <li class="menu--list_item">
            <img src="<?php echo $user_picture->fetch_assoc()['picture_url']; ?>" alt="Profile Picture">
        </li><!-- menu-list--item -->
    </ul><!--menu-list -->
</nav><!-- menu -->