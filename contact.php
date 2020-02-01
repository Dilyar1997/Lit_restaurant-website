<!DOCTYPE html>
<html>

<head>
  <title>Pho King Nais | Contact Us.</title>
  <?php @include("./components/head_tag.php"); ?>
</head>

<body class="site-container">
  <?php
  @include("./components/layout/navigation.php");
  ?>

  <div class="index_background">
    <div class="index_background_fill"></div>
    <img class="index_background_shape" src="./media/test_2.svg">
  </div>

  <header class='index_header'>
    <h1><a href="./index.php">Pho King Nais</a></h1>
    <h2>Contact Us.</h2>
  </header>

  <main class="site-content">
    <div class="page_wrapper">
      <div class="split">
        <div class="reservation_container">
          <div class='contact_list'>
            <ul>
              <li><b>Email:</b> <a href="mailto:info@phokingnais.com?Subject=Hello%20again" target="_top">info@Pho-King-Nais.com</a></li>
              <li><b>Phone:</b> <a href="tel:123-456-7890">123-456-7890</a></li>
              <li><b>Adress:</b> Nieuwezijds Voorburgwal 147, 1012 RJ Amsterdam</li>
            </ul>

            <div id="map"></div>
            <script>
              function initMap() {
                var Damsquare = {
                  lat: 52.373321,
                  lng: 4.892482
                };
                var map = new google.maps.Map(
                  document.getElementById('map'), {
                    zoom: 17,
                    center: Damsquare
                  });
                var marker = new google.maps.Marker({
                  position: Damsquare,
                  map: map
                });
              }
            </script>

          </div>
        </div>

        <div class="reservation_container">
          <img class="split_image" src="./media/restaurant_interior.jpg" alt="Pho King Nais Noodles">
        </div>
      </div>
    </div>
  </main>

  <?php @include('./components/layout/footer.php'); ?>
</body>
<script src="./scripts/global.js"></script>

</html>
