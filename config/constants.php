<?php
    # Start session
    session_start();
    define('DB_NAME','todo-app');
    define('HOST','localhost');
    define('USER_NAME','root');
    define('USER_PASSWORD','');
    define('SITEURL',"http://localhost:63342/todo_list/");



    $conn = mysqli_connect(HOST,USER_NAME,USER_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());


?>