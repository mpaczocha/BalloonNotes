<?php
session_start();
include('connection.php');

// Get the id of notes sent through Ajax
$note_id = $_POST['id'];

// Run a query to delete the note
$sql = "DELETE FROM notes WHERE id='$note_id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}

?>