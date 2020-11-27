<div class="error-container error">
    <span>
        <?php
            if (isset($_SESSION['show_error'])) {
                echo $_SESSION['show_error'];
                unset($_SESSION['show_error']);
            }
        ?>
    </span>
</div><!-- error-container -->