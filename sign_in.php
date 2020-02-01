<?php
session_start();

if (empty($_SESSION['csrf_key'])) {
  $_SESSION['csrf_key'] = bin2hex(random_bytes(32));
}
$csrf_key = $_SESSION['csrf_key'];

if (isset($_SESSION['loggedIN'])) {
  if ($_SESSION['activation_code'] == 'activated') {
    header('Location: account.php');
    exit();
  } else {
    header('Location: not_activated.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Pho King Nais | Sign in.</title>
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
    <form method="post" action="./components/login.php" class="sign-in-form-2">
      <h3 class="sign-in-heading-2">Pho King Nais</h3>
      <p class="sign-in-title-2">Sign in</p>
      <input type="text" id="sign-in-email" placeholder="Email">
      <div class="email-warning"></div>
      <input type="password" id="sign-in-password" placeholder="Password" autocomplete="on">
      <div class="password-warning"></div>
      <input type="button" id="sign-in-button" value="Sign In">
      <input type="hidden" id="csrf_key" value="<?php echo $csrf_key; ?>" />
      <a href="#" class="sign-in-forgot-2" onclick='showPopup()'>Forgot password?</a>
      <input type="button" id="sign-up-button" value="Register">
    </form>
  </main>

  <?php @include('./components/layout/footer.php'); ?>
</body>

<script type="text/javascript">
  function showPopup() {
    $.get('./components/forgot_pass_popup.php', function(data) {
      $('body').append(data);
    });

    setTimeout(() => {
      $('.forgot-pass-popup').addClass('forgot-pass-popup--show');
    }, 250);
  }

  $(document).ready(function() {
    $('#sign-in-button').on('click', function() {
      var email = $('#sign-in-email').val();
      var password = $('#sign-in-password').val();
      var csrf_key = $('#csrf_key').val();

      $('.email-warning').html('');
      $('.password-warning').html('');

      if (!isEmail(email)) {
        $('.email-warning').html('Please enter a valid email address!');
        $('#sign-in-email').css('border', '1px solid red');
        return;
      }

      if (password == "") {
        $('.password-warning').html('Please enter a valid password!');
        $('#sign-in-password').css('border', '1px solid red');
        return;
      }

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
          if (response.indexOf('success') >= 0) {
            window.location = 'account.php';
          } else {
            $('.password-warning').html('Invalid information!')
          }
        },
        dataType: 'text'
      })
    });

    $('#sign-up-button').on('click', function() {
      window.location = 'registration.php';
    });

  });
</script>

<script src="./scripts/global.js"></script>

</html>