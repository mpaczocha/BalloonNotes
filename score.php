<?php
session_start();
include('connection.php');
// Get the user_id ussing session variables
$user_id = $_SESSION['user_id'];
$moves = $_POST['moves'];

// Check for the same score
$sql = "SELECT * FROM memory WHERE user_id='$user_id' AND score='$moves'";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count == 0){

    // Run a query to save new score
    $sql = "INSERT INTO memory (user_id, score) VALUES ('$user_id', '$moves')";
    $result = mysqli_query($link, $sql);
    if(!$result){
        echo 'error';
    }
}

?>