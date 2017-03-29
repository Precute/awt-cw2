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
       "<body class='row' id ='mybody'><div id='divlogo'><canvas class='img-responsive' id='logo' width='624' "    .
       "height='96'>$appname</canvas></div>"             .
       "<div class='appname'></div>"            .
       " <script async defer\n" .
       "      src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyDZX4BJpzyeVj8ZNrc1xuwHyKP34ZHudyA\">\n".
       "    </script>\n" .

       "<script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js\"></script>" .

       "<script type='text/javascript' src='js/jquery.gomap.js'></script> ".
       "<script src='js/javascript.js'></script>" .
       "<script src='js/geoPosition.js' type='text/javascript' charset='utf-8'></script> ".
       "<script src='js/geoPositionSimulator.js' type='text/javascript' charset='utf-8'></script>".
       "  <script src='js/bootstrap.min.js'></script>" .
       "  <script src='js/geolocationHomepageScript.js'>\n" .
       "  </script>\n"; 
       ?>
            <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
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
    echo "      <li><a href='members.php?view=$user'>Home</a></li>\n";
    echo "      <li><a href=\"shop.php\">Merchandise Store</a></li>\n";
    echo "      <li><a href='members.php'>Members</a></li>\n";
    echo "      <li><a href='friends.php'>Friends</a></li>\n";
    echo "      <li><a href='locationhistory.php'>Location History</a></li>\n";
    echo "      <li><a href='messages.php'>Messages</a></li>\n";
    echo "      <li><a href='profile.php'>Profile</a></li>\n";
    if ($user === 'huseyin'){
      echo "      <li><a href='shop.php#/orders'>Order Admin</a></li>\n";
      echo "      <li><a href='shop.php#/addproduct'>Admin - Add Product</a></li>\n";
    }
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
    echo "      <a class=\"navbar-brand\" href=\"index.php\">$appname$userstr</a>\n";
    echo "    </div>\n";
    echo "    <ul class=\"nav navbar-nav\">\n";
    echo "      <li><a href=\"index.php\">Home</a></li>\n";
    echo "      <li><a href=\"shop.php\">Merchandise Store</a></li>\n";
    echo "    </ul>\n";
    echo "    <ul class=\"nav navbar-nav navbar-right\">\n";
    echo "      <li><a href=\"signup.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>\n";
    echo "      <li><a href=\"login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>\n";
    echo "    </ul>\n";
    echo "  </div>\n";
    echo "</nav>";
  }
?>
