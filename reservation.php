<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pho King Nais | Make a reservation.</title>
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
        <h2>See you soon.</h2>

        <div class="reservation-picker">
            <select class="reservation_picker_select" onchange="handlePeopleChange(value)">
                <option value="1">1 person</option>
                <option value="2" selected>2 people</option>
                <option value="3">3 people</option>
                <option value="4">4 people</option>
                <option value="5">5 people</option>
                <option value="6">6 people</option>
                <option value="7">7 people</option>
                <option value="8">8 people</option>
                <option value="9">9 people</option>
                <option value="10">10 people</option>
                <option value="11">11 people</option>
                <option value="12">12 people</option>
            </select>

            <input type="input" class="datepicker" required="required" onchange="handleDateChange(value)" />

            <select class="reservation_picker_select" onchange="handleTimeChange(value)">
                <option value="18:00:00">18:00</option>
                <option value="18:30:00" selected>18:30</option>
                <option value="19:00:00">19:00</option>
                <option value="19:30:00">19:30</option>
                <option value="20:00:00">20:00</option>
                <option value="20:30:00">20:30</option>
                <option value="21:00:00">21:00</option>
                <option value="21:30:00">21:30</option>
                <option value="22:00:00">22:00</option>
                <option value="22:30:00">22:30</option>
                <option value="23:00:00">23:00</option>
            </select>

            <select class="reservation_picker_select" onchange="handleMenuChange(value)">
                <option value="1" selected>à la carte</option>
                <option value="2">3-courses</option>
                <option value="4">5-courses</option>
                <option value="3">7-courses</option>
            </select>
        </div>
    </header>

    <main class="site-content">
        <div class="reservation_wrapper">
            <div class='reservation_table'>
                <div class='location r-option chef-table' onclick="handleLocationChange('chef-table')">
                    <img src="./media/chef-table.jpg" alt="chef-table" class='img'>
                    <p>Chef's Table</p>
                </div>
                <div class='location r-option bar-table' onclick="handleLocationChange('bar-table')">
                    <img src="./media/bar-table.jpg" alt="bar-table" class='img'>
                    <p>At the bar</p>
                </div>
                <div class='location  r-option normal-table' onclick="handleLocationChange('normal-table')">
                    <img src="./media/normal-table.jpg" alt="normal-table" class='img'>
                    <p>Regular table</p>
                </div>
            </div>
        </div>

        <div class="reservation_button"></div>
    </main>

    <?php @include('./components/layout/footer.php'); ?>
</body>

<script type="text/javascript">
    var dateToday = new Date();
    var selectedLocation = null;
    var selectedDate = dateToday;
    var selectedPeople = 2;
    var selectedTime = '18:30:00';
    var selectedMenu = 1;

    function showPopup() {
        $.get('./components/reservation_popup.php', function(data) {
            $('body').append(data);
        });
        setTimeout(() => {
            $('.reservation_popup').addClass('reservation_popup__show');
        }, 250);
    };

    function handlePeopleChange(value) {
        selectedPeople = value;
    };

    function handleTimeChange(value) {
        selectedTime = value;
    };

    function handleDateChange(value) {
        selectedDate = value;
    };

    function handleMenuChange(value) {
        selectedMenu = value;
    };

    function send_reservation() {
        const date = new Date(Date.parse(selectedDate));
        const time = selectedTime.split(/\:|\-/g);

        date.setHours(time[0]);
        date.setMinutes(time[1]);

        if (String(date.getMonth() + 1).length == 1) {
            var month = '0' + String(date.getMonth() + 1);
        } else {
            var month = String(date.getMonth() + 1);
        };

        if (String(date.getDate()).length == 1) {
            var day = '0' + String(date.getDate());
        } else {
            var day = String(date.getDate());
        };

        if (String(date.getMinutes()).length == 1) {
            var minutes = '0' + String(date.getMinutes());
        } else {
            var minutes = String(date.getMinutes());
        };

        var date_string = String(date.getFullYear()) + "-" + month + "-" + day + " " + String(date.getHours()) + ":" + minutes + ":00";

        $.ajax({
            url: './scripts/send_reservation.php',
            method: 'POST',
            data: {
                date_time: date_string,
                people: selectedPeople,
                location: selectedLocation,
                menu: selectedMenu
            },
            success: function(response) {
                console.log(response);
                if (response.indexOf('success') >= 0) {
                    window.location = 'success.php';
                }
            },
            dataType: 'text'
        });
    };

    function handleLocationChange(location) {
        selectedLocation = location;

        $('.location').removeClass('location__active')
            .addClass("location__not_active");

        $(`.${selectedLocation}`).removeClass("location__not_active")
            .addClass('location__active');

        if (selectedLocation) {
            $('.reservation_button').html("<div class='book_now_confirm' onclick='showPopup()'>BOOK YOUR TABLE</div>")
        };
    };

    $(function() {
        $(".datepicker").datepicker({
            numberOfMonths: 1,
            minDate: dateToday,
            showAnim: 'slideDown'
        });

        $(".datepicker").datepicker("setDate", new Date());
    });
</script>

</html>