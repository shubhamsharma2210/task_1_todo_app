<?php 
session_start();
include('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "DELETE FROM task WHERE `id` = $id ";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Error occured in delete.php".mysqli_error());
    }else{
        $_SESSION['dlt_msg'] = "Your task has deleted successfully";
        header('Location: index.php');
    }

}



 







?>