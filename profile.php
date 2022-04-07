<?php include './partials/header.php' ?>

<!--  Header Starts  -->
<header>
    <div class="wrapper space-between">
        <div class="logo">
            Wale's Todo List
        </div>
        <div class="navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="history.php">History</a></li>
                <li class="active"><a href="profile.php">Profile</a></li>
                <li><a href="./partials/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<!--  Header Ends  -->

<?php
$id = $_SESSION['user'];
$sql = "SELECT * FROM tbl_users WHERE id=$id";
$res = mysqli_query($conn, $sql);

if ($res == true) {
    $count = mysqli_num_rows($res);
    if ($count > 1) {
        echo "Something wierd happened";
    } else {
        $row = mysqli_fetch_assoc($res);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $profile_img = $row['profile_img'];
    }
} else {
    echo "Something went wrong";
}

?>

<!--  Main Content Starts  -->
<div class="main-content">
    <div class="wrapper">
        <!--  History  -->
        <div class="profile">
            <div class="top">
                <h1>Profile</h1>
            </div>

            <div class="profile__image">
                <div class="img">
                    <?php
                    if ($profile_img == "no image") {
                        ?>
                        <img src="./img/account_circle_black_24dp.png" alt="">
                        <?php
                    } else {
                        ?>
                        <img src="./img/user-profiles/<?php echo $profile_img ?>" alt="">
                        <?php
                    }
                    ?>
                </div>
            </div>
            <h1 class="profile__greeting">Hello <?php echo $first_name ?></h1>

            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <label>
                        <span class="label">First Name</span>
                        <input type="text" name="first-name" value="<?php echo $first_name ?>" placeholder="First Name">
                    </label>
                    <label>
                        <span class="label">Last Name</span>
                        <input type="text" name="last-name" value="<?php echo $last_name ?>" placeholder="Last Name">
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span class="label">Email</span>
                        <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email Address">
                    </label>
                    <label>
                        <span class="label">Update Picture</span>
                        <input type="file" name="image">
                    </label>
                </div>
                <input type="submit" name="submit" value="Update Profile">
            </form>
        </div>

        <?php
        if (isset($_POST['submit'])) {
            $new_first_name = $_POST['first-name'];
            $new_last_name = $_POST['last-name'];
            $new_email = $_POST['email'];
            if (isset($_FILES['image'])) {
                $new_profile_img = $_FILES['image']['name'];
                if ($new_profile_img == '') {
                    $new_profile_img = $profile_img;
                } else {
                    $upload = move_uploaded_file($_FILES['image']['tmp_name'], "./img/user-profiles/$new_profile_img");
                    if ($upload == true) {
                        $remove = unlink("./img/user-profiles/$profile_img");
                        if($remove == false){
                            echo "Another thing went wrong";
                        }
                    }else{
                        echo "Something went wrong";
                    }
                }
                echo $new_profile_img;
            } else {
                $new_profile_img = $profile_img;
            }

            $sql2 = "UPDATE tbl_users SET first_name = '$new_first_name',last_name = '$new_last_name',email='$new_email',profile_img='$new_profile_img' WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                $_SESSION['update'] = "Profile Updated Successfully";
                header("location:" . SITEURL . 'index.php');
            } else {
                echo "Something went wrong!";
                echo mysqli_error($conn);
            }
        }
        ?>
    </div>
</div>
<!--  Main Content Ends  -->


<!--  Footer Starts  -->
<footer>
    <div class="wrapper">

    </div>
</footer>
<!--  Footer Ends  -->
</body>
</html>