<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');
include('rememberme.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My notes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <style>
        #container{
            margin-top: 60px;
        }
        #notePad, #saveNote, #done, .delete{
            display: none;
        }
        .buttons{
            margin-bottom: 15px;
            font-weight: 700;
        }
        h1{
            border-bottom: 1px solid white;
            padding-bottom: 5px;
            margin-bottom: 10px;
            color: white;
            text-align: center;
        }
        textarea{
            width: 100%;
            resize: vertical;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #1B2B55;
            color: #1B2B55;
            background-color: #FBEFFF;
            padding: 10px;
        }
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF, #ECEAE7);
        }
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .timetext{
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        .row{
            margin-bottom: 40px;
        }
        .delete{
            padding-left: 0;
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
                    <li class="active">
                        <a href="mainpageloggedin.php">My notes</a>
                    </li>
                    <li>
                        <a href="memoryGame.php">Memory Game</a>
                    </li>
                    <li>
                        <a href="profile.php">Profile</a>
                    </li>
                    <li>
                        <a href="contactUsLogged.php">Contact us</a>
                    </li>
                </ul>
                <!-- <ul class="nav navbar-nav pull-right"> It also works in the toggle button :/ -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a>Logged in as <b><?php echo $_SESSION['username']?></b>
                        </a>
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
        <!-- Alert Message -->
        <div id="alert" class="alert alert-danger collapse">
            <a class="close" data-dismiss="alert">
                &times;
            </a>
            <p id="alertContent"></p>
        </div>
        <div class="col-md-offset-3 col-md-6"><h1>My notes</h1></div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                <div class="buttons">
                    <button id="addNote" type="button" class="btn green btn-lg">Add Note</button>
                    <button id="edit" type="button" class="btn green btn-lg pull-right">Edit</button>
                    <button id="done" type="button" class="btn btn-lg green pull-right">Done</button>
                    <button id="saveNote" type="button" class="btn green btn-lg">Save Note</button>
                </div>
                <div id="notePad">
                    <textarea rows="10"></textarea>
                </div>
                <div id="notes" class="notes">
                    <!-- Ajax call to PHP file -->
                </div>
            </div>
        </div>
    </div>

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
    <script src="mynotes.js"></script>
</body>

</html>