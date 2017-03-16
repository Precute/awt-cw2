<?php // Example 26-9: members.php
  require_once 'header.php';

  if (!$loggedin) die();

  echo "<div class='container'>";

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else                $name = "$view's";
    
    echo "<h3>$name Profile</h3><form method = 'post' class='form-horizontal'><div class='row'>";
    ?>
    <div id ="indexProfile"><div class="col-sm-4">
    <?php
    showProfile($view);
    $lat = $_SESSION['lat'];
 $long = $_SESSION['long'];
    $date = date('Y-m-d h:i:s');
    if(isset($_POST['submit']))
{
  
    $shareLocation = $_POST['shareLocation'];
    
    queryMysql("INSERT INTO track_location VALUES ('$view', '$long', '$lat', '$date' , '$shareLocation')");

}else{
  $shareLocation = '1';
  queryMysql("INSERT INTO track_location VALUES ('$view', '$long', '$lat', '$date' , '$shareLocation')");
}
 
 
     echo "<div class='form-group'>".
      "<div class='col-sm-10'>" .
        "<a class='btn btn-info' href='messages.php?view=$view'>" .
         "<span class='glyphicon glyphicon-envelope' style='margin-right: 0.5em'></span>View $name messages</a><br><br>" .
    "</div>".
    "</div></div></div><div class='col-sm-8'>".
    "<div id=\"location\" style = 'color: #2d94b5;'><b>Current Location: </b>" .
     "<div class='radio-inline'>".
      "<label><input type='radio' name='shareLocation' value= '0' >Public</label>".
    "</div>".
    "<div class='radio-inline'>".
      "<label><input type='radio' name='shareLocation' value= '1' checked='checked' >Private  </label>".
    "</div><input type='submit' name='submit' class='btn btn-default' value='Share'/></div>".
    "<div id = \"showMap\" style= \"width:100%;height:500px\"></div></div>";
    die("</div></div></form></body></html>");
  }
  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    if (!$result->num_rows)
      queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
  }

  $result = queryMysql("SELECT user FROM members ORDER BY user");
  $num    = $result->num_rows;

  echo "<div class='row'><h3>Other Members</h3><div class='mainList'><ul>";
       
  echo "<div id =id=\"otherMember\" ><div class='col-sm-10'>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) continue;
    
    echo "<li><a href='members.php?view=" .
      $row['user'] . "'>" . $row['user'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='" . $row['user'] . "' AND friend='$user'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='$user' AND friend='" . $row['user'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
      $follow = "recip"; }
    
    if (!$t1) echo " [<a href='members.php?add="   .$row['user'] . "'>$follow</a>]";
    else      echo " [<a href='members.php?remove=".$row['user'] . "'>drop</a>]";


  }
  echo "</ul></div>" .
      "<div class='col-sm-8'><div id =\"memberMap\" style= \"width:100%;height:500px\">" .
      "</div></div></div>";
?>

    </div></div></div>
  </body>
</html>
