<?php
session_start();
include('connection.php');

// Get the id of notes sent through Ajax
$id = $_POST['id'];

// Get the content of note
$note = $_POST['note'];

// Get the time
$time = time();

// Run a query to update the note
$sql = "UPDATE notes SET note='$note', time='$time' WHERE id='$id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}

?>