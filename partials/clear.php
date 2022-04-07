<?php
include "../config/constants.php";

$sql = "DELETE FROM tbl_todo WHERE removed='Yes'";
$res = mysqli_query($conn,$sql);
if($res==true){
    $_SESSION['clear-all'] = "History cleared successfully!";
    header("location:".SITEURL.'/history.php');
}else{
    $_SESSION['clear-all'] = "Something went wrong!";
    header("location:".SITEURL.'/history.php');
}

?>