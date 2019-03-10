<?php
// The user is re-directed to this file after clicking the link received by email and aiming at proving they own the new email address
// SignUp link contains three GET parameters: email, newemail and activation key
session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Email Activation</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        h1{
            color:  purple;
        }
        .contactForm{
            border: 1px solid #7c73F6;
            margin-top: 50px;
            border-radius: 15px;
        }
    </style>
</head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-offset-1 col-sm-10 contactForm">
                    <h1>Email activation</h1>

<?php
// If email, newemail or activation key is missing show an error
if(!isset($_GET['email']) || !isset($_GET['newemail']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
    exit;
}
// else
// Store them in variables
$email = $_GET['email'];
$newemail = $_GET['newemail'];
$key = $_GET['key'];

// Prepare variables for the query
$email = mysqli_real_escape_string($link, $email);
$newemail = mysqli_real_escape_string($link, $newemail);
$key = mysqli_real_escape_string($link, $key);

// Run query: update email
$sql = "UPDATE users SET email='$newemail', activation2='0' WHERE (email='$email' AND activation2='$key') LIMIT 1";
$result = mysqli_query($link, $sql);

// If query is successful, show success message
if(mysqli_affected_rows($link) == 1){
    session_destroy();
    setcookie("rememberme", "", time()-3600);
    echo '<div class="alert alert-success">Your email has been updated</div>';
    echo '<a href="index.php" type="button" class="btn-lg btn-success">Log in!</a>';
}else{
    // Show error message
    echo '<div class="alert alert-danger">Your email could not be updated. Please try again later.</div>';
}

?>
                </div>
            </div>
        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>