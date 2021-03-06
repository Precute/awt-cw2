<?php // Example 26-1: functions.php
  $dbhost  = 'mudfoot.doc.stu.mmu.ac.uk';    // Unlikely to require changing
  $dbname  = 'tanveeah';   // Modify these...
  $dbuser  = 'tanveeah';   // ...variables according
  $dbpass  = 'wErthlep4';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference

  //$dbhost = ; // the database host
//$dbuser = 'igbinoso' ; 
//$dbpass = 'jesSplam6' ; // password

//$dbhost = 'mysql:host=127.0.0.1;dbname=test';
//$dbname = 'root';
//$dbpass = 'password';

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
  if ($connection->connect_error) die($connection->connect_error);

  function createTable($name, $query)
  {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
  }

  function queryMysql($query)
  {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    return $result;
  }

  function destroySession()
  {
    $_SESSION=array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
      setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
  }

  function sanitizeString($var)
  {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $connection->real_escape_string($var);
  }

  function showProfile($user)
  {
    if (file_exists("$user.jpg"))
      echo "<img src='$user.jpg' ><br>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    
    if ($result->num_rows)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      echo stripslashes("<div id= 'myProfile'><br><br><span class='glyphicon glyphicon-info-sign' style='margin-right: 0.40em'><b><p>".  $row['text']) . "</p></b><br style='clear:left;'><br></div>";
    }
  }
  
?>
