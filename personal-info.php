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
$lname = $_SESSION['lastName'];
$email = $_SESSION['email'];
$roleID = $_SESSION['role_id'];

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
            <h4>Name</h4>
            <p><?php echo $fname ?> <?php echo $lname ?> </p>
            <h4>Email Address</h4>
            <p><?php echo $email ?></p>
            <h4>Role</h4>
            <?php if ($roleID == '4') : ?>
                <p>Customer</p>
            <?php elseif ($roleID == '3') : ?>
                <p>Staff</p>
            <?php elseif ($roleID == '2') : ?>
                <p>Owner</p>
            <?php else : ?>
                <p>Admin</p>
            <?php endif; ?>
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