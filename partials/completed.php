
<?php
include "../config/constants.php";

$user_id = $_GET['user_id'];
$todo_id = $_GET['todo_id'];

$sql1 = "SELECT * FROM tbl_todo WHERE todo_id=$todo_id AND user_id=$user_id";
$res1 = mysqli_query($conn, $sql1);
if ($res1 == true) {
    $completed = mysqli_fetch_assoc($res1)['completed'];
    if ($completed == "Yes") {
        $completed = "No";
    } else {
        $completed = "Yes";
    }
} else {
    $_SESSION['no-complete'] = "Could not set completion status";
    header("location:" . SITEURL . "index.php");
    die();
}

$sql2 = "UPDATE tbl_todo SET completed = '$completed' WHERE todo_id=$todo_id AND user_id=$user_id";
$res2 = mysqli_query($conn, $sql2);

if ($res2 == true) {
    $_SESSION['no-complete'] = "Task completed successfully";
    header("location:" . SITEURL . "index.php");
} else {
    $_SESSION['no-complete'] = "Something went wrong";
    die();
}
?>