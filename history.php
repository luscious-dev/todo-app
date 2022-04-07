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
                <li class="active"><a href="history.php">History</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="./partials/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</header>
<!--  Header Ends  -->


<!--  Main Content Starts  -->
<div class="main-content">
    <div class="wrapper">
        <p class="messenger">
            <?php
            if (isset($_SESSION['clear-all'])) {
                echo $_SESSION['clear-all'];
                unset($_SESSION['clear-all']);
            }

            ?>
        </p>
        <!--  History  -->
        <div class="history">
            <div class="top">
                <h1>History</h1>
            </div>
            <div class="scroll-wrap">
                <ul class="history-list">
                    <?php
                    $user_id = $_SESSION['user'];
                    $sql = "SELECT * FROM tbl_todo WHERE removed='Yes' AND user_id=$user_id";
                    $res = mysqli_query($conn,$sql);

                    if($res == true){
                        $count = mysqli_num_rows($res);
                        if($count != 0){
                            while ($row = mysqli_fetch_assoc($res)){
                                $task = $row['todo_task'];
                                $date = $row['date_removed'];
                                ?>
                                <li class="history-list__item">
                                    <span><?php echo $task ?></span>
                                    <span><?php echo $date ?></span>
                                </li>
                                <?php
                            }
                        }else{
                            ?>
                            <li class="history-list__item">
                                <span>Nothing to see here. Run along now!</span>
                                <span></span>
                            </li>
                            <?php
                        }
                    }else{
                        echo mysqli_error($conn);
                    }
                    ?>

                </ul>
            </div>
            <div class="bottom">
                <a href="./partials/clear.php">Clear all</a>
            </div>

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