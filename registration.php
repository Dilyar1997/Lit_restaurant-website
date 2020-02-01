<?php
session_start();

if (empty($_SESSION['csrf_key'])) {
  $_SESSION['csrf_key'] = bin2hex(random_bytes(32));
}
$csrf_key = $_SESSION['csrf_key'];

if (isset($_SESSION['loggedIN'])) {
  header('Location: account.php');
  exit();
}

?>

<!DOCTYPE html>
<html>

<head>
  <?php @include("./components/head_tag.php"); ?>
  <title>Pho King Nais | Registration</title>
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
    <form method="POST" action="./components/register.php" class="register-form">
      <h3 class="sign-in-heading-2">Pho King Nais</h3>
      <p class="sign-in-title-2">Create a new account</p>
      <input type="text" id="sign-in-fname" placeholder="First name">
      <span class="fname-warning"></span>
      <input type="text" id="sign-in-lname" placeholder="Last name">
      <span class="lname-warning"></span>
      <input type="text" id="sign-in-email" placeholder="Email">
      <div class="email-warning"></div>
      <input type="password" id="sign-in-password" placeholder="Password" autocomplete="on">
      <input type="password" id="sign-in-passwordRepeat" placeholder="Repeat password" autocomplete="on">
      <input type="hidden" id="csrf_key" value="<?php echo $csrf_key; ?>" />
      <div class="password-warning"></div>

      <div id="Length" class="glyphicon glyphicon-remove">Must be at least 7 charcters</div>
      <div id="UpperCase" class="glyphicon glyphicon-remove">Must have atleast 1 upper case character</div>
      <div id="LowerCase" class="glyphicon glyphicon-remove">Must have atleast 1 lower case character</div>
      <div id="Numbers" class="glyphicon glyphicon-remove">Must have atleast 1 numeric character</div>
      <div id="Symbols" class="glyphicon glyphicon-remove">Must have atleast 1 special character</div>

      <input type="button" id="register-confirm-button" value="Register">
      <a href="./sign_in.php" class="sign-in-forgot-2">Already have an account? Sign in here.</a>
    </form>
  </main>

  <?php @include('./components/layout/footer.php'); ?>
</body>

<script>
  $(document).ready(function() {

    $("#sign-in-password").on('keyup', ValidatePassword);

    $('#register-confirm-button').on('click', function() {
      var first_name = $('#sign-in-fname').val();
      var last_name = $('#sign-in-lname').val();
      var email = $('#sign-in-email').val();
      var password = $('#sign-in-password').val();
      var passwordRepeat = $('#sign-in-passwordRepeat').val();
      var csrf_key = $('#csrf_key').val();

      $('#sign-in-fname').css('border', '');
      $('.fname-warning').html('');

      $('#sign-in-lname').css('border', '');
      $('.lname-warning').html('');

      $('.email-warning').html('');
      $('#sign-in-email').css('border', '');

      $('.password-warning').html('');

      if (first_name == "") {
        $('.fname-warning').html('Please enter your first name!');
        $('#sign-in-fname').css('border', '1px solid red');
        return;
      }

      if (last_name == "") {
        $('.lname-warning').html('Please enter your last name!');
        $('#sign-in-lname').css('border', '1px solid red');
        return;
      }

      if (!isEmail(email)) {
        $('.email-warning').html('Please enter a valid email address!');
        $('#sign-in-email').css('border', '1px solid red');
        return;
      }

      if (password !== passwordRepeat) {
        $('.password-warning').html('Passwords are not matching!');
        $('#sign-in-password').css('border', '1px solid red');
        $('#sign-in-passwordRepeat').css('border', '1px solid red');
        return;
      }

      if (password == "") {
        $('.password-warning').html('Please enter a valid password!');
        $('#sign-in-password').css('border', '1px solid red');
        return;
      }

      $.ajax({
        url: './scripts/register.php',
        method: 'POST',
        data: {
          first_name: first_name,
          last_name: last_name,
          email: email,
          password: password,
          csrf_key: csrf_key
        },
        success: function(response) {
          console.log(response);
          if (response.indexOf('success') >= 0) {
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
                }
              },
              dataType: 'text'
            })
          } else {
            $('.password-warning').html('Email address already in use!')
          }
        },
        dataType: 'text'
      })
    });
  });
</script>

<script src="./scripts/global.js"></script>

</html>