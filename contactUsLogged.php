<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location: index.php");
}
include('connection.php');
include('rememberme.php');
$username = $_SESSION['username'];
$email = $_SESSION['email'];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact us</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
        <link href="styling.css" rel="stylesheet">
        <link href="css/fontello.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
                        <li>
                            <a href="profile.php">Profile</a>
                        </li>
                        <li class="active">
                            <a href="contactUsLogged.php">Contact us</a>
                        </li>
                    </ul>
                    <!-- <ul class="nav navbar-nav pull-right"> It also works in the toggle button :/ -->
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#">Logged in as
                                <b>
                                    <?php echo $_SESSION['username']?>
                                </b>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?logout=1">Log out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Contact form -->
        <div class="form-container">
            <div class="col-md-6 col-md-offset-2">
                <h1>Get in Touch with Us</h1>
                <h4>We want to hear from You! Fill in the form below to contact us:</h4>
                <form id="contact-form" method="post" action="contact.php" role="form">
                    <!-- Contact message for PHP file -->
                    <div id="contactmessage"></div>
                    <div class="controls">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_name">Name *</label>
                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your name *" required="required"
                                        data-error="Firstname is required." value=<?php echo $_SESSION[ 'username']?>>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="form_email">Email *</label>
                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required"
                                        data-error="Valid email is required." value=<?php echo $_SESSION[ 'email']?>>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="form_message">Message *</label>
                                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required"
                                        data-error="Please,leave us a message."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <input type="submit" name="contact-form" class="btn btn-send green" value="Send message">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-muted">
                                    <strong>*</strong> These fields are required.</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.form-container-->


        <!-- Footer -->
        <div class="footer">
            <div class="col-md-3 col-md-offset-4">Developed with Mateusz &copy; 2018.</div>
            <a href="https://www.facebook.com/mateusz.paczocha" target="_blank">
                <div class="fb col-md-1">
                    <p class="icon-facebook"></p>
                </div>
            </a>
            <a href="https://github.com/mpaczocha" target="_blank">
                <div class="github col-md-1">
                    <p class="icon-github-circled"></p>
                </div>
                <a href="https://www.linkedin.com/in/mateuszpaczocha" target="_blank">
                    <div class="linkedin col-md-1">
                        <p class="icon-linkedin"></p>
                    </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="index.js"></script>
        <!-- <script src="validator.js"></script> -->
        <!-- <script src="contact.js"></script> -->
    </body>

    </html>