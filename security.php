<?php
session_start();

if (!isset($_SESSION['loggedIN'])) {
    header('Location: sign_in.php');
    exit();
} else {
    if ($_SESSION['activationCode'] !== 'activated') {
        header('Location: not_activated.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Pho King Nais | You're signed in!</title>
    <?php @include("./components/head_tag.php"); ?>
</head>

<body class="site-container">
    <?php
    @include('./components/layout/navigation.php');
    ?>

    <div class="index_background">
        <div class="index_background_fill"></div>
        <img class="index_background_shape" src="./media/test_2.svg">
    </div>

    <header class='index_header'>
        <h1><a href="./index.php">Pho King Nais</a></h1>
    </header>

    <main class="site-content">
        <div class="personal-info-container">
            <div class="return-button">
                <img src="./media/return.svg" onclick="returnPage()" />
            </div>
            <div class="content-container">
                <h3>Change your password</h3>
                <form action="./scripts/changePassword.php" method="POST">
                    <input type='password' id='old-password' placeholder='Old password'>
                    <input type='password' id='new-password' placeholder='New password'>
                    <input type='password' id='new-password-repeat' placeholder='Repeat password'>
                    <div class="password-warning"></div>
                    <input type="button" id="change-confirm-button" value="Submit">
                </form>
            </div>
        </div>
    </main>


    <?php @include('./components/layout/footer.php'); ?>
</body>

<script type="text/javascript">
    $(document).ready(function() {

        $('.return-button').on('click', function() {
            window.location = 'account.php';
        });
    });

    $('#change-confirm-button').on('click', function() {
        var old_password = $('#old-password').val();
        var new_password = $('#new-password').val();
        var new_passwordRepeat = $('#new-password-repeat').val();

        $('.password-warning').html('');

        if (old_password == "" || new_password == "" || new_passwordRepeat == "") {
            $('.password-warning').html('Please enter a valid password!');
            $('#old-password').css('border', '1px solid red');
            $('#new-password').css('border', '1px solid red');
            $('#new-password-repeat').css('border', '1px solid red');
            return;
        }

        if (new_password !== new_passwordRepeat) {
            $('.password-warning').html('Passwords are not matching!');
            $('#new-password').css('border', '1px solid red');
            $('#new-password-repeat').css('border', '1px solid red');
            return;
        }

        $.ajax({
            url: './scripts/changePassword.php',
            method: 'POST',
            data: {
                login: 1,
                old_password: old_password,
                new_password: new_password
            },
            success: function(response) {
                console.log(response);
                if (response.indexOf('success') >= 0) {
                    window.location = 'account.php';
                } else {
                    $('.password-warning').html('Your old password is wrong!')
                }
            },
            dataType: 'text'
        })
    });
</script>

<script src="./scripts/global.js"></script>

</html>