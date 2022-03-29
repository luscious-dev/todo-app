<?php include './partials/header.php' ?>

<!--  Header Starts  -->
<header>
    <div class="wrapper space-between">
        <div class="logo">
            Wale's Todo List
        </div>
        <div class="navigation">
            <ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="history.php">History</a></li>
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
        <!--  Todo List  -->
        <p class="messenger">
            <?php
            if (isset($_SESSION['new-user'])) {
                echo $_SESSION['new-user'];
                unset($_SESSION['new-user']);
            }
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if (isset($_SESSION['add-task'])) {
                echo $_SESSION['add-task'];
                unset($_SESSION['add-task']);
            }
            ?>
        </p>
        <div class="todo">
            <div class="top">
                <h1>Todo </h1>
                <div class="search-bar">
                    <form action="#" method="post">
                        <input type="text" name="task" placeholder="Add a new Task">
                        <input type="submit" name="submit" value="Add Task">
                    </form>

                    <?php
                        if(isset($_POST['submit'])){
                            $task = $_POST['task'];
                            if($task != ""){
                                $id = $_SESSION['user'];
                                $date = date("Y-m-d");
                                $sql2 = "INSERT INTO tbl_todo SET user_id=$id,todo_task=\"$task\",date_added='$date',completed='No',removed='No'";
                                $res2 = mysqli_query($conn,$sql2);

                                if($res2 == true){
                                    $_SESSION['add-task'] = "Task added successfully";
                                    header("location:".SITEURL."index.php");
                                }else{
                                    $_SESSION['add-task'] = "Something went wrong";
                                    header("location:".SITEURL."index.php");
                                }
                            }else{
                                $_SESSION['add-task'] = "Fill in the task field";
                                header("location:".SITEURL."index.php");
                            }
                        }
                    ?>
                </div>
            </div>
            <div class="scroll-wrap">
                <ul class="todo-list">
                    <?php
                    $user_id = $_SESSION['user'];
                    $removed = 'No';

                    # Query to retrieve the todos for the specified user
                    $sql = "SELECT * FROM tbl_todo WHERE user_id=$user_id AND removed='$removed'";
                    $res = mysqli_query($conn, $sql);


                    if ($res == true) { # If the query was executed successfully
                        $count = mysqli_num_rows($res);

                        if ($count > 0) { # If there is at least one todo for the user in the database

                            while ($row = mysqli_fetch_assoc($res)) { # Dynamically produce a list of the todo for the user
                                $task = $row['todo_task'];
                                $completed = $row['completed'];
                                ?>
                                <li class="todo-list__task <?php if ($completed == 'Yes') {
                                    echo 'todo-list__task--complete';
                                } ?>">
                                    <span><?php echo $task ?></span>
                                    <div class="actions">
                                        <a href="#"><img src="./img/done_black_24dp.png" alt="done"></a>
                                        <a href="#"><img src="./img/mode_edit_outline_black_24dp.png" alt="edit"></a>
                                        <a href="#"><img src="./img/close_black_24dp.png" alt="close"></a>
                                    </div>
                                </li>
                                <?php
                            }
                        } else { # If there happens to be no todo for the user in the database
                            ?>
                            <li class="todo-list__task">
                                <span>No tasks yet. Add Some</span>
                            </li>
                            <?php
                        }
                    } else { # Query did not execute well
                        $_SESSION['todo'] = "Something went wrong";
                        echo "Something went wrong";
                    }
                    ?>
                </ul>
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