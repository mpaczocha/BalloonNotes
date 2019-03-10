<?php
// Start session
session_start();
// Connect to the database
include('connection.php');

// Create variables
$errors = "";
$username = "";
$email ="";
$password = "";

// Check user inputs
// Define error messages
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';

//Get email and store errors in errors variable
if(empty($_POST["forgotemail"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["forgotemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

//If there are any errors print error message
if($errors){
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}

//No errors
//Prepare variables for the queries
$email = mysqli_real_escape_string($link, $email);

// Run query to check if the email exists in the users table -->
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">That email does not exists on our database!</div>';
    exit;
}

// Get the user_id
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$user_id = $row['user_id'];

// Create unique activation code
$key = bin2hex(openssl_random_pseudo_bytes(16));
$time = time();
$status = 'pending';

// Insert user details and activation code in the forgotpassword table
$sql = "INSERT INTO forgotpassword (user_id, rkey, time, status) VALUES ('$user_id', '$key', '$time', '$status')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

// Send the user an email with a link to resetpassword.php with user id and activation code
$message = "Please click on this link to reset your password:\n\n";
$message .= "http://www.mpaczocha.pl/resetpassword.php?user_id=$user_id&key=$key" ;
if(mail($email, 'Reset your password', $message, 'From:' . 'mpaczocha.pl')){
    echo '<div class="alert alert-success">An email has been sent. Please click on the link to reset your password</div>';
}

?>

