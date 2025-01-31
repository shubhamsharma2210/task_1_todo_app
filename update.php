<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db.php'); 

$task = "";
$id = "";

// Check if we are editing a task
if (isset($_GET['id'])) {
    $id =  $_GET['id'];
    $query = "SELECT * FROM `task` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $task = $row['task'];
    }
}

// Handle form submission
if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    if ($id) {
        // Update query
        $query = "UPDATE `task` SET `task` = '$task' WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error occurred while updating: " . mysqli_error($conn));
        } else {
            $_SESSION['updt_msg'] = "Thank You! Task Updated Successfully!";
            header("Location: index.php");
            exit();
        }
    } else {
        // validate task
        function validateTask($task) {
            if (empty($task)) {
                return "Task cannot be empty!";
            } elseif (strlen($task) < 3) {
                return "Task must be at least 3 characters long!";
            } elseif (strlen($task) > 255) {
                return "Task cannot exceed 255 characters!";
            }
            return "";
        }
        
        // add task
        if (isset($_POST['add_task'])) {
            $task = $_POST['task'];
            $validationError = validateTask($task);
        
            if ($validationError !== "") {
                $_SESSION['error'] = " $validationError";
                header('Location: index.php');
            } else {
                $query = "INSERT INTO task(task) VALUES ('$task')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Error occurred in insert.php " . mysqli_error($conn));
                } else {
                    $_SESSION['add_task'] = "Task Added Successfully....";
                    header('Location: index.php');
                }
            }
        }
    }
}
?>
