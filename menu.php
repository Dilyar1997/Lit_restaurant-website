<!DOCTYPE html>
<html>

<head>
  <title>Pho King Nais | Menu.</title>
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
    <div class="index_titles">
      <h1><a href="./index.php">Pho King Nais</a></h1>
      <h2>Rice before guys!</h2>
      <h3>Try one of our original Pho King recipes!</h3>
    </div>
  </header>

  <main class="site-content">
    <div class="page_wrapper">
      <div class="index_subtitle">
        <br>
        <h3><u> Main Dishes: </u></h3>
        <?php @include('./components/menu_button_1.php'); ?>
        <h5>
          <center><em>Traditional Vietnamese Pho soup with chicken.</em></centre>
        </h5>
        <?php @include('./components/menu_button_3.php'); ?>
        <h5>
          <center><em>Pho soup with chicken, sesame seed and 64˚ egg yolk</em></centre>
        </h5>
        <?php @include('./components/menu_button_5.php'); ?>
        <h5>
          <center><em>Pho soup with Broccoli, Sesame Seed and Cashew Nuts</em></centre>
        </h5>
        <h5><i>Note: all our dishes are served in three sizes: Pho King Small, Pho King Average, and Pho King Huge.</i></h5>
        <br>
        <h3><u> Side Dishes: </u></h3>
        <?php @include('./components/menu_button_4.php'); ?>
        <?php @include('./components/menu_button_2.php'); ?>
        <?php @include('./components/menu_button_5.php'); ?>
      </div>


      <div class="split split_reversed">
        <div class="container">
          <img class="split_image" src="./media/restaurant_interior.jpg" alt="Restaurant Interior">
        </div>

        <div class="container">
          <div class="index_subtitle">
            <h2>Noodles. Reinvented.</h2>
          </div>

          <div class="body_text">
            <p>Our noodles are produced by hand here in Amsterdam. Pho King Nais has opened several "conversion shops" where local children learn the Chinese standards for labour first hand! </p>
            <p></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php @include('./components/layout/footer.php'); ?>

</body>
<script src="./scripts/global.js"></script>

</html>