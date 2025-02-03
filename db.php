<?php


// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "test_todo";


$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//  else{
//      echo "database are connected successfully" ;
//  }

?>