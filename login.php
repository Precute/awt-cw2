<?php // Example 26-7: login.php
  require_once 'header.php';
  echo "<div class='container'>";
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    
    if ($user == "" || $pass == "")
        $error = "<span class='error'>Not all fields were entered</span><br>";
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("<h2>Welcome </h2> You are now logged in. Please <a href='members.php?view=$user'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' class="form-horizontal" action='login.php'>$error
    <h2>Please enter your details to log in</h2>
    <div class="form-group">
      <label class="control-label col-sm-2" >Username:</label>
      <div class="col-sm-10">
        <input  type='text' maxlength='16' name='user' value='$user'
      onBlur='checkUser(this)' class="form-control"  placeholder="Enter Username">
      </div>
    </div>

   
    
    <div class="form-group">
      <label class="control-label col-sm-2" >Password:</label>
      <div class="col-sm-10">
        <input  type='password' maxlength='16' name='pass' value='$pass'
      onBlur='checkUser(this)' class="form-control"  placeholder="Enter Password">
      </div>
    </div>
_END;
?>

    <br>
    <span class='fieldname'>&nbsp;</span>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" value='Sign up' class="btn btn-default"><span class="glyphicon glyphicon-log-in" style="margin-right: 0.5em"></span>Login</button>
      </div>
    </div>
    </form><br></div>
  </body>
</html>
