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

$fname = $_SESSION['firstName'];
$roleID = $_SESSION['role_id'];

?>
<!DOCTYPE html>
<html>

<head>
    <title>Pho King Nais | Hello, <?php echo $fname ?></title>

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
        <h2>Hello, <?php echo $fname ?>.</h2>
    </header>

    <main class="site-content">
        <div class="settings-wrapper">
            <div class='settings-table'>
                <div class='settings-button personal-info'>
                    <h4>Personal info</h4>
                    <p>Provide personal details and how we can reach you.</p>
                </div>
                <div class='settings-button security'>
                    <h4>Login & security</h4>
                    <p>Update your password and secure your account.</p>
                </div>
                <div class='settings-button reservations'>
                    <?php if ($roleID == '4') : ?>
                        <h4>Reservations</h4>
                        <p>Find all your upcoming and past PhoKingNais reservations.</p>
                    <?php else : ?>
                        <h4>Restaurant bookings</h4>
                        <p>Find all the upcoming and past PhoKingNais guest reservations.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <?php @include('./components/layout/footer.php'); ?>
</body>
<script type="text/javascript">
    $(document).ready(function() {

        $('.personal-info').on('click', function() {
            window.location = 'personal-info.php';
        });

        $('.security').on('click', function() {
            window.location = 'security.php';
        });

        <?php if ($roleID == '4') : ?>
            $('.reservations').on('click', function() {
                window.location = 'reservations.php';
            });
        <?php else : ?>
            $('.reservations').on('click', function() {
                window.location = 'bookings.php';
            });
        <?php endif; ?>
    });
</script>

<script src="./scripts/global.js"></script>

</html>