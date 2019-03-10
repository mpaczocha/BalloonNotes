<?php
session_start();
include('connection.php');
include('logout.php');
include('rememberme.php');
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
            <a href="index.php">Home</a>
          </li>
          <li class="active">
            <a href="contactUs.php">Contact us</a>
          </li>
        </ul>
        <!-- <ul class="nav navbar-nav pull-right"> It also works in the toggle button :/ -->
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="#loginModal" data-toggle="modal">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Login form -->
  <form method="post" id="loginform">
    <div class="modal" id="loginModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="myModalLabel">Login to your account:</h4>
          </div>
          <div class="modal-body">
            <!-- Login message for PHP file -->
            <div id="loginmessage"></div>

            <div class="form-group">
              <label for="loginemail" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="loginemail" id="loginemail" placeholder="Email" maxlength="50">
            </div>
            <div class="form-group">
              <label for="loginpassword" class="sr-only">Password:</label>
              <input class="form-control" type="password" name="loginpassword" id="loginpassword" placeholder="Password" maxlength="30">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="rememberme" id="rememberme" style="display:none;">
              </label>
              <a class="pull-right" style="cursor: pointer" data-dismiss="modal" data-target="#forgotpasswordModal" data-toggle="modal">Forgot Password?</a>
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn green" name="login" type="submit" value="Login">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Forgot password form -->
  <form method="post" id="forgotpasswordform">
    <div class="modal" id="forgotpasswordModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="myModalLabel">Forgot Password? Enter your email address:</h4>
          </div>
          <div class="modal-body">
            <!-- Forgot password message for PHP file -->
            <div id="forgotpasswordmessage"></div>

            <div class="form-group">
              <label for="forgotemail" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="forgotemail" id="forgotemail" placeholder="Email" maxlength="50">
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn green" name="forgotpassword" type="submit" value="Submit">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal" data-target="#signupModal" data-toggle="modal">Register</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Sign up form -->
  <form method="post" id="signupform">
    <div class="modal" id="signupModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="myModalLabel"><b>SIGN UP</b> now and start using our BalloonNotes App!</h4>
          </div>
          <div class="modal-body">
            <!-- Sign up message for PHP file -->
            <div id="signupmessage"></div>

            <div class="form-group">
              <label for="username" class="sr-only">Username:</label>
              <input class="form-control" type="text" name="username" id="username" placeholder="Username" maxlength="30">
            </div>
            <div class="form-group">
              <label for="email" class="sr-only">Email:</label>
              <input class="form-control" type="email" name="email" id="email" placeholder="Email address" maxlength="50">
            </div>
            <div class="form-group">
              <label for="password" class="sr-only">Password:</label>
              <input class="form-control" type="password" name="password" id="password" placeholder="Choose a password" maxlength="30">
            </div>
            <div class="form-group">
              <label for="password2" class="sr-only">Password2:</label>
              <input class="form-control" type="password" name="password2" id="password2" placeholder="Confirm a password" maxlength="30">
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn green" name="signup" type="submit" value="Sign up">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Contact form -->
  <div class="form-container">
        <div class="col-md-6 col-md-offset-2">
            <h1>Get in Touch with us</h1>
            <h4>We want to hear from you! Fill in the form below to contact us:</h4>
            <form id="contact-form" method="post" action="contact.php" role="form">
              <!-- Contact message for PHP file -->
                <div id="contactmessage"></div>
                <div class="controls">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_name">Name *</label>
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your name *" required="required" data-error="Firstname is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="form_email">Email *</label>
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="form_message">Message *</label>
                                <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <input type="submit" name="contact-form" class="btn btn-send green" value="Send message">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-muted"><strong>*</strong> These fields are required.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
  </div> <!-- /.form-container-->

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
  <script src="index.js"></script>
  <!-- <script src="validator.js"></script> -->
  <!-- <script src="contact.js"></script> -->
</body>
</html>