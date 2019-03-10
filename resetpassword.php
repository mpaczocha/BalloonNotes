<?php
// This file receives the user_id and key generated to create the new password
// This file displays a form to input new password

session_start();
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
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
                    <h1>Reset password</h1>
                    <div id="resultmessage"></div>

<?php

// If user_id or key is missing print error message
if(!isset($_GET['user_id']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
    exit;
}

// Else: store them in two variables
$user_id = $_GET['user_id'];
$key = $_GET['key'];
$time = time() - 86400;

// Prepare variables for the query
$user_id = mysqli_real_escape_string($link, $user_id);
$key = mysqli_real_escape_string($link, $key);

// Run query: Check combination of user_id & key exists and less than 24h old
$sql = "SELECT user_id FROM forgotpassword WHERE rkey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    // echo '<div class="alert alert-danger">' . mysqli_error($link) . '</div>';
    exit;
}

// If combination does not exist print error message
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Please try again!</div>';
    exit;
}

// Else: print reset password form with hidden user_id and key fields
echo "
<form method='post' id='passwordreset'>
    <input type='hidden' name='key' value='$key'>
    <input type='hidden' name='user_id' value='$user_id'>
    <div class='form-group'>
        <label for='password'>Enter your new password</label>
        <input type='password' name='password' id='password' placeholder='Enter password' class='form-control'>
    </div>
    <div class='form-group'>
        <label for='password2'>Re-enter password</label>
        <input type='password' name='password2' id='password2' placeholder='Re-enter password' class='form-control'>
    </div>
    <input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>
</form>";

?>
                </div>
            </div>
        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script for Ajax Call to storeresetpassword.php which processes form data -->
    <script>
        // Once the form is submitted
        $("#passwordreset").submit(function(event){
        // prevent default php processing
        event.preventDefault();
        // collect user inputs
        var datatopost = $(this).serializeArray();
        // console.log(datatopost);
        // send them to forgotpassword.php using AJAX
            // $.post({}).done().fail(); Alternative method for ajax call
            // $.get().done().fail(); Alternative method for ajax call
        $.ajax({
        url: "storeresetpassword.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $("#resultmessage").html(data);
            },
            error: function(){
                $("#resultmessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
            },
            });
        });

    </script>

    </body>
</html>