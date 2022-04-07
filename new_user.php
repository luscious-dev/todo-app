<?php include "./config/constants.php"; ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./styles/main.css">
        <title>Todo App</title>
    </head>

    <body>
    <!--  Header Starts  -->
    <header>
        <div class="wrapper space-between">
            <div class="logo">
                Wale's Todo List
            </div>

        </div>
    </header>
    <!--  Header Ends  -->


    <!--  Main Content Starts  -->
    <div class="main-content">
        <div class="wrapper">
            <!--  History  -->
            <div class="sign-up">
                <p class="messenger">
                    <?php
                    if (isset($_SESSION['account-create'])) {
                        echo $_SESSION['account-create'];
                        unset($_SESSION['account-create']);
                    }
                    if (isset($_SESSION['password-prob'])) {
                        echo $_SESSION['password-prob'];
                        unset($_SESSION['password-prob']);
                    }
                    ?>
                </p>
                <div class="sign-up__img">
                    <img src="./img/account_circle_black_24dp.png" alt="account image">
                </div>
                <form action="#" method="post">
                    <label>
                        <span class="label">First Name</span>
                        <input type="text" name="first_name" placeholder="First Name">
                    </label>
                    <label>
                        <span class="label">Last Name</span>
                        <input type="text" name="last_name" placeholder="Last Name">
                    </label>
                    <label>
                        <span class="label">Email</span>
                        <input type="email" name="email" placeholder="Email Address">
                    </label>
                    <label>
                        <span class="label">Password</span>
                        <input type="password" name="password" placeholder="Password">
                    </label>
                    <label>
                        <span class="label">Confirm Password</span>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </label>
                    <input type="submit" name="sign-up" value="Sign Up">
                </form>
                <a href="login.php">Already a user?</a>
            </div>

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

<?php
if (isset($_POST['sign-up'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (($first_name != '') and ($last_name != '') and ($email != '') and ($password != '') and $confirm_password != '') {
        if ($password == $confirm_password) {
            $encrypted_password = md5($password);
        } else {
            $_SESSION['password-prob'] = "Your Passwords do not match. Try again";
            header("location:" . SITEURL . "new_user.php");
        }
        $sql = "INSERT INTO tbl_users SET 
                    first_name = '$first_name',
                    last_name = '$last_name',
                    email = '$email',
                    password = '$encrypted_password',
                    profile_img = 'no image'";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $sql2 = "SELECT * FROM tbl_users WHERE email='$email'";
            $res2 = mysqli_query($conn,$sql2);
            $id = mysqli_fetch_assoc($res2)['id'];
            $_SESSION['user'] = $id;
            $_SESSION['new-user'] = "Account creation successful";
            header("location:" . SITEURL . "index.php");
        }

    } else {
        $_SESSION['account-create'] = "Fill in all the fields";
        header("location:" . SITEURL . "new_user.php");
    }
}
?>