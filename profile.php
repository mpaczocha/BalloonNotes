<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');
include('rememberme.php');
$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else{
    echo 'There was an error retrieving the username and email from database';
}

//get number of notes
$sql = "SELECT * FROM notes WHERE user_id='$user_id'";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
$notesNumber = $count;

// get best score
$sql = "SELECT * FROM memory WHERE user_id='$user_id' ORDER BY score ASC";
$result = mysqli_query($link, $sql);
$count = mysqli_num_rows($result);
if($count == 0){
    $bestScore = "n/a";
}else{
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $bestScore = $row['score'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <style>
        #container{
            font-size: 15px;
            margin-top: 60px;
            color: white;
        }
        tr{
            cursor: pointer;
            font-weight: 500;
            vertical-align: center;
            color: #19284E;
            background-color: white;
            letter-spacing: 0.01em;
        }
        tr:hover{
            color: white;
            background-color: #24377B !important;
        }
        td:first-child{
            width: 45px;
        }
        h1{
            border-bottom: 1px solid white;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }
        span{
            display: block;
            margin: 0;
            text-align center;
            vertical-align: middle;
        }
        .under-table{
            border-top: 1px solid white;
            padding: 5px 0 0 5px;
            font-weight: 300;
            letter-spacing: 0.01em;
        }

    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Balloon Notes</a>
                <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="mainpageloggedin.php">My notes</a>
                    </li>
                    <li>
                        <a href="memoryGame.php">Memory Game</a>
                    </li>
                    <li class="active">
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="contactUsLogged.php">Contact us</a>
                    </li>

                </ul>
                <!-- <ul class="nav navbar-nav pull-right"> It also works in the toggle button :/ -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#">Logged in as <b><?php echo $username?></b></a>
                    </li>
                    <li>
                        <a href="index.php?logout=1">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container" id="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-5">
                <h1>General account settings</h1>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <tr data-target="#updateusername" data-toggle="modal">
                            <td><span class="icon-user"></span></td>
                            <td>Username</td>
                            <td><?php echo $username?></td>
                        </tr>
                        <tr data-target="#updateemail" data-toggle="modal">
                            <td><span class="icon-mail"></span></td>
                            <td>Email</td>
                            <td><?php echo $email?></td>
                        </tr>
                        <tr data-target="#updatepassword" data-toggle="modal">
                            <td><span class="icon-key"></span></td>
                            <td>Password</td>
                            <td>hidden</td>
                        </tr>
                        <tr>
                            <td><span class="icon-list-bullet"></span></td>
                            <td>Number of notes</td>
                            <td><?php echo $notesNumber?></td>
                        </tr>
                        <tr>
                            <td><span class="icon-star"></span></td>
                            <td>Memory - Best score</td>
                            <td><?php echo $bestScore?></td>
                        </tr>
                    </table>
                </div>
                <div class="under-table">
                    If you want to change username, e-mail or password click properly line above.
                </div>
            </div>
        </div>
    </div>

    <!-- Update username -->
    <form method="post" id="updateusernameform">
        <div class="modal" id="updateusername" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="myModalLabel">Edit Username:</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Update username message for PHP file -->
                        <div id="updateusernamemessage"></div>

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" maxlength="30" value="<?php echo $username?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updateusername" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Update email -->
    <form method="post" id="updateemailform">
        <div class="modal" id="updateemail" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="myModalLabel">Enter new email:</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Update email message for PHP file -->
                        <div id="updateemailmessage"></div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" type="email" name="email" id="email" maxlength="50" value="<?php echo $email?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn green" name="updateemail" type="submit" value="Submit">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <!-- Update password -->
    <form method="post" id="updatepasswordform">
            <div class="modal" id="updatepassword" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="myModalLabel">Enter Current and New password:</h4>
                        </div>
                        <div class="modal-body">
                            <!-- Update password message for PHP file -->
                            <div id="updatepasswordmessage"></div>

                            <div class="form-group">
                                <label for="currentpassword" class="sr-only">Your current password:</label>
                                <input class="form-control" type="password" name="currentpassword" id="currentpassword" maxlength="30" placeholder="Your current password">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Choose a password:</label>
                                <input class="form-control" type="password" name="password" id="password" maxlength="30" placeholder="Choose a password">
                            </div>
                            <div class="form-group">
                                <label for="password2" class="sr-only">Confrim password:</label>
                                <input class="form-control" type="password" name="password2" id="password2" maxlength="30" placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input class="btn green" name="updateusername" type="submit" value="Submit">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

  
        <!-- Footer -->
  <div class="footer">
    <div class="col-md-3 col-md-offset-4">Developed with Mateusz &copy; 2018.</div>
    <a href="https://www.facebook.com/mateusz.paczocha" target="_blank"><div class="fb col-md-1"><p class="icon-facebook"></p></div></a>
    <a href="https://github.com/mpaczocha" target="_blank"><div class="github col-md-1"><p class="icon-github-circled"></p></div>
    <a href="https://www.linkedin.com/in/mateuszpaczocha" target="_blank"><div class="linkedin col-md-1"><p class="icon-linkedin"></p></div>
  </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="profile.js"></script>
</body>

</html>