<?php // Example 26-11: messages.php
  require_once 'header.php';

  if (!$loggedin) die();

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if (isset($_POST['text']))
  {
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
      $pm   = substr(sanitizeString($_POST['pm']),0,1);
      $time = time();
      queryMysql("INSERT INTO messages VALUES(NULL, '$user',
        '$view', '$pm', $time, '$text')");
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
      $name1 = "<a href='members.php?view=$view'>$view</a>'s";
      $name2 = "$view's";
    }

    echo "<div class='container'><h3>$name1 Messages</h3>";
    showProfile($view);
    
    echo <<<_END
      <form class='form-horizontal' method='post' action='messages.php?view=$view'>
      Type here to leave a message:<br>
      <div class="form-group">
      <div class="col-sm-10">
        <textarea name='text' cols='50' rows='3'></textarea>
      </div>
    </div>
      
      <div class="radio-inline">
      <label><input type="radio" name="pm" value= '0' checked="checked" >Public</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="pm" value= '1' >Private</label>
    </div>
       <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" value='Post Message' class="btn btn-default"><span class="glyphicon glyphicon-level-up" style="margin-right: 0.5em"></span>Post Message</button>
      </div>
    </div></form>
_END;

    if (isset($_GET['erase']))
    {
      $erase = sanitizeString($_GET['erase']);
      queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
      {
        echo date('M jS \'y g:ia:', $row['time']);
        echo " <a href='messages.php?view=" . $row['auth'] . "'>" . $row['auth']. "</a> ";

        if ($row['pm'] == 0)
          echo "wrote: &quot;" . $row['message'] . "&quot; ";
        else
          echo "whispered: <span class='whisper'>&quot;" .
            $row['message']. "&quot;</span> ";

        if ($row['recip'] == $user)
          echo "[<a href='messages.php?view=$view" .
               "&erase=" . $row['id'] . "'>erase</a>]";

        echo "<br>";
      }
    }
  }

  if (!$num) echo "<br><span class='info'>No messages yet</span><br><br>";

  echo "<br><br><div class='form-group'>".
      "<div class='col-sm-10'>" .
        "<a class='btn btn-info' href='messages.php?view=$view'>" .
         "<span class='glyphicon glyphicon-retweet' style='margin-right: 0.5em'></span>Refresh Messages</a><br><br>" .
      "</div>";
?>

    </div><br>
  </body>
</html>
