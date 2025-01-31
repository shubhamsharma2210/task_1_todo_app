<?php 
include('db.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];


    $query = "DELETE FROM task WHERE `id` = $id ";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Error occured in delete.php".mysqli_error());
    }else{
        header('Location: index.php?message="Your task has deleted successfully"');
    }

}



 







?>