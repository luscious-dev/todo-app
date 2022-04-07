
<?php
include "../config/constants.php";

$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];
$todo_task = $_GET['todo_task'];


$date = date("Y-m-d");


$sql = "UPDATE tbl_todo SET removed = 'Yes', date_removed = '$date' WHERE todo_id=$todo_id AND user_id=$user_id";
$res = mysqli_query($conn, $sql);
if ($res == true) {
    $_SESSION['no-complete'] = "Task removed successfully";
    header("location:" . SITEURL . "index.php");
} else {
    $_SESSION['no-complete'] = "Something went wrong";
    die();
}

?>