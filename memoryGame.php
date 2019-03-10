<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
include('connection.php');
include('rememberme.php');

$user_id = $_SESSION['user_id'];
$score = "";

// get best score
$sql = "SELECT * FROM memory WHERE user_id='$user_id' ORDER BY score ASC";
$result = mysqli_query($link, $sql);

$count = mysqli_num_rows($result);
if($count == 0){
  $score = "n/a";
}else{
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $score = $row['score'];
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Memory game</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <link href="styling.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
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
            <li class="active">
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
              <a>Logged in as
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

    <!-- Game div -->
    <div class="game-container">
      <div class="col-md-offset-4 col-md-4 game-title">
        <h1>Memory Game</h1>
      </div>
      <div class="game-scores">
        <div class="moves">
          Moves:
        </div>
        <div id="movesValue">
          0
        </div>
        <div class="bestScore">
          Your best score:
        </div>
        <div id="bestScoreValue">
          <?php echo $score?>
        </div>
        <div>
          <button class="btn game-start green">Start game</button>
        </div>
        <div style="clear:both"></div>
      </div>
      <div class="game-board">
      </div>
    </div>

    <!-- Game over form -->
    <form method="post" id="gameoverform">
      <div class="modal" id="gameoverModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="myModalLabel">Congratulations!</h4>
            </div>
            <div class="modal-body">
              <!-- Game over message for PHP file -->
              <div id="gameovermessage"></div>
              <div class="form-group">
                <label for="moves">Your score:</label>
                <input class="form-control" type="text" name="moves" id="moves" maxlength="10" value="" readonly="readonly">
              </div>
            </div>
            <div class="modal-footer">
              <input class="btn green" id="submit" name="moves" type="submit" value="Save my score!">
            </div>
          </div>
        </div>
      </div>
    </form>

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
    <script src="script.js"></script>
  </body>

  </html>