<?php
session_start();

// kill session
if (isset($_SESSION['loggedIN'])) {
    unset($_SESSION['loggedIN']);
    session_destroy();
    exit("success");
}
