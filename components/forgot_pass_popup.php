<?php
session_start();

$csrf_key = $_SESSION['csrf_key'];
?>

<div class='forgot-pass-popup'>
    <div class="close-button">
        <img src="./media/close.svg" onclick="closePopup()" />
    </div>
    <h1 class="popup_title"></h1>

    <div class="forgot-pass-form">
        <p class="forgot-title">Forgot your password?</p>
        <input id="forgot-email" placeholder="Your Email Address"><br>
        <input type="hidden" id="csrf_key" value="<?php echo $csrf_key; ?>" />
        <div class="forgot-warning"></div>
        <input type="button" id="forgot-button" value="Reset Password">
        <p id="response"></p>
    </div>
</div>

<script type="text/javascript">
    function closePopup() {
        $('.forgot-pass-popup').removeClass('forgot-pass-popup--show');

        setTimeout(() => {
            $('.forgot-pass-popup').remove();
        }, 250);
    };

    var email = $("#forgot-email");
    var csrf_key = $('#csrf_key').val();

    $(document).ready(function() {
        $('#forgot-button').on('click', function() {

            $('.forgot-warning').html('');

            if (!isEmail(email.val())) {
                $('.forgot-warning').html('Please enter a valid email address!').css('color', "red");
                $('#forgot-email').css('border', '1px solid red');
                return;
            };

            $.ajax({
                url: './scripts/forgotPassword.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    email: email.val(),
                    csrf_key: csrf_key
                },
                success: function(response) {
                    console.log(response);
                    if (!response.status) {
                        $('.forgot-warning').html(response.msg).css('color', "red");
                        return;
                    }
                    $('.forgot-warning').html(response.msg).css('color', "green");
                    $('#forgot-email').css('border', '1px solid green');
                }
            });
        });
    });
</script>