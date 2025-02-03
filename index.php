<?php
    session_start();
    include("db.php");
    include('update.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Todo List</title>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Todo list</h1>
        </div>
        <div class="box">
            <div class="error-msg">
                <?php
                // All messages
                if(isset($_SESSION['error'])){
                    echo "<h2 class='message' style='color: #8B0000'   >". "Error :" . $_SESSION['error']."</h2>";
                    unset($_SESSION['error']);
                }
                
                if(isset($_SESSION['updt_msg'])){
                    echo "<h2 class='message'>". $_SESSION['updt_msg']."</h2>";
                    unset($_SESSION['updt_msg']);
                }
                if(isset($_SESSION['add_task'])){
                    echo "<h2 class='message' style='color: green'>". 'Success :'. $_SESSION['add_task']."</h2>";
                    unset($_SESSION['add_task']);
                }
                if(isset($_SESSION['dlt_msg'])){
                    echo "<h2 class='message' style='color:rgba(139, 0, 0, 0.88)'>". 'Deleted :'. $_SESSION['dlt_msg']."</h2>";
                    unset($_SESSION['dlt_msg']);
                }
                ?>
            </div>
            <div class="form-container">
                <form action="update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="text" name="task" placeholder="Write Task Here" value="<?php echo htmlspecialchars($task, ENT_QUOTES, 'UTF-8'); ?>">
                    <input class="add-btn" type="submit" value="<?php echo $id ? 'Update' : 'Add'; ?>" name="add_task">
                </form>
            </div>
            <span class="line"></span>
        </div>
        <div class="list_item">
            <ul>
                <?php    
                    $query = "SELECT * FROM `task`";
                    $result = mysqli_query($conn, $query);
                    if(!$result){
                        die("Error occurred in index.php".mysqli_error($conn));
                    } else {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <li>' . htmlspecialchars($row['task'], ENT_QUOTES, 'UTF-8') . '
                                    <div class="action-buttons">
                                        <button class="first-btn"><a href="index.php?id=' . $row['id'] . '">Update</a></button>
                                        <button style="background-color:red;" class="first-btn"><a  href="delete.php?id=' . $row['id'] . '">Delete</a></button>
                                    </div>
                                </li>
                            ';
                        }
                    }
                ?>
            </ul>
        </div>
        <!-- <footer class="footer">
        <p>© 2025 Shubham sharma. Test-1 : Todo App.</p>
        <p>Powered by <a href="#">Believ-in Technology Pvt ltd.</a></p>
    </footer> -->
    </div>
</body>
</html>