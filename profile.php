<?php // Example 26-8: profile.php
  require_once 'header.php';

  if (!$loggedin) die();

  echo "<div class='container'><h3>Your Profile</h3>";

  $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
    
  if (isset($_POST['text']))
  {
    $text = sanitizeString($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);

    if ($result->num_rows)
         queryMysql("UPDATE profiles SET text='$text' where user='$user'");
    else queryMysql("INSERT INTO profiles VALUES('$user', '$text')");
  }
  else
  {
    if ($result->num_rows)
    {
      $row  = $result->fetch_array(MYSQLI_ASSOC);
      $text = stripslashes($row['text']);
    }
    else $text = "";
  }

  $text = stripslashes(preg_replace('/\s\s+/', ' ', $text));

  if (isset($_FILES['image']['name']))
  {
    $saveto = "$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;

    switch($_FILES['image']['type'])
    {
      case "image/gif":   $src = imagecreatefromgif($saveto); break;
      case "image/jpeg":  // Both regular and progressive jpegs
      case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
      case "image/png":   $src = imagecreatefrompng($saveto); break;
      default:            $typeok = FALSE; break;
    }

    if ($typeok)
    {
      list($w, $h) = getimagesize($saveto);

      $max = 100;
      $tw  = $w;
      $th  = $h;

      if ($w > $h && $max < $w)
      {
        $th = $max / $w * $h;
        $tw = $max;
      }
      elseif ($h > $w && $max < $h)
      {
        $tw = $max / $h * $w;
        $th = $max;
      }
      elseif ($max < $w)
      {
        $tw = $th = $max;
      }

      $tmp = imagecreatetruecolor($tw, $th);
      imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
      imageconvolution($tmp, array(array(-1, -1, -1),
        array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
      imagejpeg($tmp, $saveto);
      imagedestroy($tmp);
      imagedestroy($src);
    }
  }

  showProfile($user);

  echo <<<_END
    <form class='form-horizontal' method='post' action='profile.php' enctype='multipart/form-data'>
    <h3><b>Enter or edit your details and/or upload an image</b></h3>
    
    <div class="form-group">
      <div class="col-sm-10">
        <textarea name='text' cols='50' rows='3'>$text</textarea>
      </div>
    </div>

_END;
?>

  <div class="form-group">
      <label class="control-label col-sm-2" >Image:</label>
      <div class="col-sm-10">
      <input type='file' name='image' size='14'class="btn btn-default" >
      </div>
    </div>

   
    <button type='submit' value='Save Profile' class="btn btn-default"><span class="glyphicon glyphicon-save" style="margin-right: 0.5em"></span>Save</button><br>
    </form></div><br>
  </body>
</html>
