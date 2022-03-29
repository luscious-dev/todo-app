<?php
    include "../config/constants.php";
    unset($_SESSION['user']);
    $_SESSION['logged-out'] = "Logged out successfully";
    header("location:".SITEURL.'login.php');
?>