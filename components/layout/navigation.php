<?php session_start(); ?>

<nav id="page-nav">
    <label for="hamburger">&#9776;</label>
    <input type="checkbox" id="hamburger" />
    <ul>
        <a href="./index.php">Home</a>
        <a href="./menu.php">Menu</a>
        <a href="./reservation.php">Reservations</a>
        <a href="./contact.php">Contact</a>
        <a href="./account.php">Account</a>

        <?php if (isset($_SESSION['loggedIN'])) : ?>
            <a id="log_out_link" href="#" style="text-decoration:none">Log Out</a>
        <?php else : ?>
            <a id="log_in_link" href="sign_in.php" style="text-decoration:none">Sign In</a>
        <?php endif; ?>
    </ul>
</nav>

<script type="text/javascript">
    $(document).ready(function() {
        $('#log_out_link').on('click', function() {
            $.ajax({
                url: './scripts/logout.php',
                method: 'POST',
                success: function(response) {
                    console.log(response);
                    if (response.indexOf('success') >= 0)
                        window.location = 'sign_in.php';
                },
                dataType: 'text'
            })
        });
    });
</script>