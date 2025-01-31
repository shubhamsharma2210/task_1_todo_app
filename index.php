<?php
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
                if(isset($_GET['error'])){
                    echo "<h2 class='message' style='color: #8B0000'   >". "Error :" . $_GET['error']."</h2>";
                }

                
                if(isset($_GET['message'])){
                    echo "<h2 class='message'>". $_GET['message']."</h2>";
                }
                if(isset($_GET['add_msg'])){
                    echo "<h2 class='message' style='color: green'>". 'Success :'. $_GET['add_msg']."</h2>";
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
        <footer class="footer">
        <p>© 2025 Your Name. All rights reserved.</p>
        <p>Powered by <a href="https://example.com">Your Company</a></p>
    </footer>
    </div>
</body>
</html>