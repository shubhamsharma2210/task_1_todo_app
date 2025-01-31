<?php 
include('db.php'); // Added missing semicolon

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
            header("Location: index.php?message=Thank You! Task Updated Successfully!");
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
        
            // check validation
            if ($validationError !== "") {
                header('Location: index.php?error=' . $validationError);
            } else {
                $query = "INSERT INTO task(task) VALUES ('$task')";
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    die("Error occurred in insert.php " . mysqli_error($conn));
                } else {
                    header('Location: index.php?add_msg=Task Added Successfully....');
                }
            }
        }
    }
}
?>
