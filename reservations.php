<?php
session_start();

include_once './scripts/functions.php';

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
    <?php @include('./components/layout/navigation.php'); ?>

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
            <h4>Reservations</h4>
            <?php
            $orderList = findOrders();
            while ($row = $orderList->fetch_array()) {
                $date_splitted = explode(" ", $row[2]);
            ?>
                <p> Your reservation is at <?php echo date('g:ia', strtotime($row[2])) ?> on <?php echo $date_splitted[0] ?> for <?php echo $row[3] ?> person(s) seated at a <?php echo $row[4] ?>.</p>
            <?php
            }
            ?>
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
</script>

<script src="./scripts/global.js"></script>

</html>