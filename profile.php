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
                <li><a href="">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<!--  Header Ends  -->


<!--  Main Content Starts  -->
<div class="main-content">
    <div class="wrapper">
        <!--  History  -->
        <div class="profile">
            <div class="top">
                <h1>Profile</h1>
            </div>

            <div class="profile__image">
                <img src="./img/account_circle_black_24dp.png" alt="">
            </div>
            <h1 class="profile__greeting">Hello Olawale</h1>

            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <label>
                        <span class="label">First Name</span>
                        <input type="text" name="first-name" placeholder="First Name">
                    </label>
                    <label>
                        <span class="label">Last Name</span>
                        <input type="text" name="last-name" placeholder="Last Name">
                    </label>
                </div>
                <div class="form-row">
                    <label>
                        <span class="label">Email</span>
                        <input type="email" name="email" placeholder="Email Address">
                    </label>
                    <label>
                        <span class="label">Update Picture</span>
                        <input type="file" name="image">
                    </label>
                </div>
                <input type="submit" value="Update Profile">
            </form>
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