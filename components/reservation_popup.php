<?php
session_start();

if (empty($_SESSION['csrf_key'])) {
    $_SESSION['csrf_key'] = bin2hex(random_bytes(32));
}
$csrf_key = $_SESSION['csrf_key'];
?>

<div class='reservation_popup'>
    <div class="close-button">
        <img src="./media/close.svg" onclick="closePopup()" />
    </div>
    <h1 class="popup_title"></h1>
    <form method="post" action="./components/login.php" class="sign-in-form">
        <h3 class="sign-in-heading">Pho King Nais</h3>
        <p class="sign-in-title">Sign in</p>
        <input type="text" id="sign-in-email" placeholder="Email">
        <input type="password" id="sign-in-password" placeholder="Password">
        <input type="hidden" id="csrf_key" value="<?php echo $csrf_key; ?>" />
        <input type="button" id="sign-in-button" value="Sign In">
    </form>
</div>

<script type="text/javascript">
    function closePopup() {
        $('.reservation_popup.php').removeClass('reservation_popup__show');

        setTimeout(() => {
            $('.reservation_popup').remove();
        }, 250);
    };

    $(document).ready(function() {
        const date = new Date(Date.parse(selectedDate));
        const time = selectedTime.split(/\:|\-/g);

        date.setHours(time[0]);
        date.setMinutes(time[1]);

        $('.popup_title').html(`Your reservation is for <b>${selectedPeople} people</b>, <b>${date.toDateString()}</b> at <b>${selectedTime} PM.</b>`);

        $('#sign-in-button').on('click', function() {
            var email = $('#sign-in-email').val();
            var password = $('#sign-in-password').val();
            var csrf_key = $('#csrf_key').val();

            if (email == "" || password == "")
                alert("Please check your inputs!");
            else {
                $.ajax({
                    url: './scripts/login.php',
                    method: 'POST',
                    data: {
                        login: 1,
                        emailPHP: email,
                        passwordPHP: password,
                        csrf_key: csrf_key
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.indexOf('success') >= 0)
                            window.location = 'success.php';
                        send_reservation();
                    },
                    dataType: 'text'
                });
            };
        });
    });
</script>