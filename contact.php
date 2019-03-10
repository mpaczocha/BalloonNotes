<?php
// Start session
session_start();

// Create variables
$errors = "";
$username = "";
$email ="";
$message = "";
$userData = "";
$myemail = "matej211@o2.pl";

// Check user inputs
// Define error messages
$missingName = '<p><strong>Please enter your name!</strong></p>';
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingMessage = '<p><strong>Please enter message for me!</strong></p>';

//Get name, email, message
//Get name
if(empty($_POST["name"])){
    $errors .= $missingName;
}else{
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
}

//Get email
if(empty($_POST["email"])){
    $errors .= $missingEmail;
}else{
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;
    }
}

//Get message
if(empty($_POST["message"])){
    $errors .= $missingMessage;
}else{
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
}


//If there are any errors print error message
if($errors){
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}

//Send admin an email with a message
$subject = "Message from:" . $name . "\n\n";
$message .= "Message:" . $message . "\n\n";
$headers = 'From: <' . $email . '> . \r\n';

mail($myemail, $subject, $message, $headers);
?>