<?php include "./config/constants.php" ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Document</title>
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
        <div class="login">
            <p class="messenger">
                <?php
                if (isset($_SESSION['not-logged-in'])) {
                    echo $_SESSION['not-logged-in'];
                    unset($_SESSION['not-logged-in']);
                }

                if (isset($_SESSION['logged-out'])) {
                    echo $_SESSION['logged-out'];
                    unset($_SESSION['logged-out']);
                }
                if (isset($_SESSION['no-login'])) {
                    echo $_SESSION['no-login'];
                    unset($_SESSION['no-login']);
                }
                ?>
            </p>
            <div class="login__img">
                <img src="./img/account_circle_black_24dp.png" alt="account image">
            </div>
            <form action="#" method="post">
                <label>
                    <span class="label">Email</span>
                    <input type="email" name="email" placeholder="Email Address">
                </label>
                <label>
                    <span class="label">Password</span>
                    <input type="password" name="password" placeholder="Password">
                </label>
                <input type="submit" name="login" value="Login">
            </form>
            <a href="new_user.php">Are you a new user?</a>
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
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        if($email == "" and $_POST['password'] == ""){
            $_SESSION['no-login'] = "Can't leave all fields empty";
            header("location:".SITEURL."login.php");
        }elseif ($email==""){
            $_SESSION['no-login'] = "Can't leave email field empty";
            header("location:".SITEURL."login.php");
        }elseif ($_POST['password']==""){
            $_SESSION['no-login'] = "Can't leave password field empty";
            header("location:".SITEURL."login.php");
        }else{
            $sql = "SELECT * FROM tbl_users WHERE email='$email'";
            $res = mysqli_query($conn,$sql);

            if($res==true){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $correct_password = $row['password'];
                    if($password == $correct_password){
                        $_SESSION['user'] = $row['id'];
                        $_SESSION['login'] = "Logged in successfully";
                        header("location:".SITEURL."index.php");
                    }else{
                        $_SESSION['no-login'] = "Invalid email or password";
                        header("location:".SITEURL."login.php");
                    }

                }else{
                    $_SESSION['no-login'] = "Invalid email or password";
                    header("location:".SITEURL."login.php");
                }
            }
        }
    }
?>