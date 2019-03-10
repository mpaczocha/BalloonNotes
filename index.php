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
  <title>Balloon Notes</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
  <link href="styling.css" rel="stylesheet">
  <link href="css/fontello.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-131713034-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-131713034-1');
  </script>

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
            <a href="index.php">Home</a>
          </li>
          <li>
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

  <!-- Jumbotron with Sign up button -->
  <div class="jumbotron" id="myContainer">
    <div>
      <h1>Balloon Notes</h1></br>
      <p>Keep, organize and share your notes.</p>
      <p>Your Notes with you wherever you are</p>
      <p>and always up to date.</p>
    </div>
    <button type="button" class="btn btn-lg green signup" data-target="#signupModal" data-toggle="modal">SIGN UP</button>
  </div>

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
            <!-- <div class="g-recaptcha" data-sitekey="6LevZEMUAAAAACe5JtOVlPiaOeCKAjjOQEd5nsnU"></div> -->
          </div>
          <div class="modal-footer">
            <input class="btn green" name="signup" type="submit" value="Sign up">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
</body>

</html>