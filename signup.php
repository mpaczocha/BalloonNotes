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

//Captcha secret2
// $captchaKey = "6LevZEMUAAAAAIE2fp94aP1tUZ_M1CJxTinP6Fme";

// Check user inputs
// Define error messages
$missingUsername = '<p><strong>Please enter a username!</strong></p>';
$missingEmail = '<p><strong>Please enter your email address!</strong></p>';
$invalidEmail = '<p><strong>Please enter a valid email address!</strong></p>';
$missingPassword = '<p><strong>Please enter a password!</strong></p>';
$invalidPassword = '<p><strong>Your password should be at least 6 characters long and include one capital letter and one number!</strong></p>';
$differentPassword = '<p><strong>Password don\'t match!</strong></p>';
$missingPassword2 = '<p><strong>Please confirm your password!</strong></p>';
// $missingCaptcha = '<p><strong>Please confirm captcha!</strong></p>';

//Get username, email, password, password2
//Get username
if(empty($_POST["username"])){
    $errors .= $missingUsername;
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
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

//Get passwords
if(empty($_POST["password"])){
    $errors .= $missingPassword;
}else if(!(strlen($_POST["password"])>6
    and preg_match('/[A-Z]/',$_POST["password"])
    and preg_match('/[0-9]/',$_POST["password"])
        )
    ){
        $errors .= $invalidPassword;
    }else{
        $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
        if(empty($_POST["password2"])){
            $errors .= $missingPassword2;
        }else{
            $password2 = filter_var($_POST["password2"], FILTER_SANITIZE_STRING);
            if($password !== $password2){
                $errors .= $differentPassword;
            }
        }
    }
// //Get captcha
// $captchaCheck = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$captchaKey.'&response='.$_POST['g-recaptcha-response']);
// $captchaResult = json_decode($captchaCheck);
// if(!($captchaResult->success)){
//     $errors .= $missingCaptcha;
// }

//If there are any errors print error message
if($errors){
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}

//No errors
//Prepare variables for the queries
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);

//Encrypte password
// $password = md5($password); - algorithm md5 produces some times the same hash code some variables
//128bits -> 32 characters

$password = hash('sha256', $password);
//256bits -> 64 characters

//If username exists in the users table print error
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">That username is already registered. Do You want to log in?</div>';
    exit;
}

//If email exists in the users table print error
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}
$results = mysqli_num_rows($result);
if($results){
    echo '<div class="alert alert-danger">That email is already registered. Do You want to log in?</div>';
    exit;
}

//Create a unique activation code
$activationKey = bin2hex(openssl_random_pseudo_bytes(16));
    //byte: unit of data = 8 bits
    //bit: 0 or 1
    //16 bytes = 16*8 = 128bits
    //(2*2*2*2)*2*2*2*2*...*2
    //16*16*...*16
    //32 characters

//Insert user details and activation code in the users table
$sql = "INSERT INTO users (username, email, password, activation) VALUES ('$username', '$email', '$password', '$activationKey')";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">There was an error inserting the users details in the database!</div>';
    echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

//Send the user an email with a link to activate.php with their email and activation code
$message = "Please click on this link to activate your account:\n\n";
$message .= "http://www.mpaczocha.pl/activate.php?email=" . urlencode($email) . "&key=$activationKey" ;
if(mail($email, 'Confirm your Registration', $message, 'From:' . 'mpaczocha.pl')){
    echo '<div class="alert alert-success">Thank you for registring! A confirmation email has been sent. Please click on the activation link to activate your account</div>';
}

?>

