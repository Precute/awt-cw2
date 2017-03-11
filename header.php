<?php // Example 26-2: header.php
  session_start();

  echo "<!DOCTYPE html>\n<html><head>";

  require_once 'functions.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  echo "<meta charset='utf-8'>" .
      "<title>$appname$userstr</title>" .
      " <link href='css/styles.css' rel='stylesheet'>".
      " <link href='css/bootstrap.min.css' rel='stylesheet'>".
       "<link href='css/bootstrap-theme.min.css' rel='stylesheet'>" .
       "</head>".
       "<body id ='mybody'><div id='divlogo'><canvas id='logo' width='624' "    .
       "height='96'>$appname</canvas></div>"             .
       "<div class='appname'></div>"            .
       "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>" .
       "<script src='js/javascript.js'></script>" .
       " <script async defer\n" .
       "      src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyApczdYj25JGm98yRR7a2YRBIOZH5vHDxI\">\n".
       "    </script>\n" .
       "  <script src='js/bootstrap.min.js'></script>" .
       "  <script src='js/geolocationHomepageScript.js'>\n" .
       "  </script>\n"; 
  echo "  <script type=\"text/javascript\">\n"; 
  echo "    window.onload = getCurrentPosition;\n"; 
  echo "  </script>\n";



  if ($loggedin)
  {

    echo "<nav class=\"navbar navbar-inverse\">\n";
    echo "  <div class=\"container-fluid\">\n";
    echo "    <div class=\"navbar-header\">\n";
    echo "      <a class=\"navbar-brand\" href=\"#\">$appname$userstr</a>\n";
    echo "    </div>\n";
    echo "    <ul class=\"nav navbar-nav\">\n";
    echo "      <li class=\"active\"><a href='members.php?view=$user'>Home</a></li>\n";
    echo "      <li><a href='members.php'>Members</a></li>\n";
    echo "      <li><a href='friends.php'>Friends</a></li>\n";
    echo "      <li><a href='#'>Location History</a></li>\n";
    echo "      <li><a href='messages.php'>Messages</a></li>\n";
    echo "      <li><a href='profile.php'>Profile</a></li>\n";
    echo "    </ul>\n";
    echo "    <ul class=\"nav navbar-nav navbar-right\">\n";
    echo "      <li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>\n";
    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";


  }
  else
  {
    echo "<nav class=\"navbar navbar-inverse\">\n";
    echo "  <div class=\"container-fluid\">\n";
    echo "    <div class=\"navbar-header\">\n";
    echo "      <a class=\"navbar-brand\" href=\"#\">$appname$userstr</a>\n";
    echo "    </div>\n";
    echo "    <ul class=\"nav navbar-nav\">\n";
    echo "      <li class=\"active\"><a href=\"index.php\">Home</a></li>\n";
    echo "    </ul>\n";
    echo "    <ul class=\"nav navbar-nav navbar-right\">\n";
    echo "      <li><a href=\"signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>\n";
    echo "      <li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>\n";
    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";
  }
?>
