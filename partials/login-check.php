<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['not-logged-in'] =  "Please login to access site";
        header("location:".SITEURL.'login.php');
    }

?>