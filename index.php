<!DOCTYPE html>
<html>

<head>
  <title>Pho King Nais | The Best Noodles in Town.</title>
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
    <h2>The best noodles in town.</h2>
    <h3>18:00 PM - 01:00 AM</h3>
  </header>

  <main class="site-content">
    <div class="page_wrapper">
      <div class="split">
        <div class="container">
          <div class="index_subtitle">
            <h2>The best of Vietnam, right here in Amsterdam.</h2>
          </div>
          <?php @include('./components/menu_button_1.php'); ?>
          <?php @include('./components/menu_button_2.php'); ?>
          <?php @include('./components/menu_button_3.php'); ?>
          <?php @include('./components/menu_button_4.php'); ?>
          <?php @include('./components/menu_button_5.php'); ?>
        </div>

        <div class="container">
          <img class="split_image" src="./media/noodles.jpg" alt="Pho King Nais Noodles">
        </div>
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
            <p>We from Pho King Nais are always looking for new ways to perfect our noodles. Only the finest ingredients end up in our traditional Pho King soups!</p>
            <p>Our noodles are produced by hand right here in Amsterdam. Pho King Nais has opened several "sweet shops" where local children learn the Chinese standards for labour first hand!</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php @include('./components/layout/footer.php'); ?>
</body>


<script src="./scripts/global.js"></script>

</html>