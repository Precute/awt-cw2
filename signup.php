<?php // Example 26-5: signup.php
  require_once 'header.php';
  
?>
<?php
  echo <<<_END
  <script>
    function checkUser(user)
    {
      if (user.value == '')
      {
        O('info').innerHTML = ''
        return
      }

      params  = "user=" + user.value
      request = new ajaxRequest()
      request.open("POST", "checkuser.php", true)
      request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
      request.setRequestHeader("Content-length", params.length)
      request.setRequestHeader("Connection", "close")

      request.onreadystatechange = function()
      {
        if (this.readyState == 4)
          if (this.status == 200)
            if (this.responseText != null)
              O('info').innerHTML = this.responseText
      }
      request.send(params)
    }

    function ajaxRequest()
    {
      try { var request = new XMLHttpRequest() }
      catch(e1) {
        try { request = new ActiveXObject("Msxml2.XMLHTTP") }
        catch(e2) {
          try { request = new ActiveXObject("Microsoft.XMLHTTP") }
          catch(e3) {
            request = false
      } } }
      return request
    }
  </script>
   <div class="container"> <h2>Please enter your details to sign up</h2>
_END;

 $error = $user = $pass = $email = $firstname = $surname = "";
  if (isset($_SESSION['user'])) destroySession();

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $email = sanitizeString($_POST['email']);
    $firstname = sanitizeString($_POST['firstname']);
    $surname = sanitizeString($_POST['surname']);


    if ($user == "" || $pass == "" || $email == "")
      $error = "Not all fields were entered<br><br>";
    else
    {
      $result = queryMysql("SELECT * FROM members WHERE user='$user'");

      if ($result->num_rows)
        $error = "That username already exists<br><br>";
      else
      {
        queryMysql("INSERT INTO members VALUES('$user', '$pass', '$email', '$firstname', '$surname', '$gender')");
        die("<h4>Account created</h4>Please<a href=\"login.php\"> Log in</a>.<br><br>");
      }
    }
  }

  echo <<<_END
 
    <form method='post' action='signup.php' class="form-horizontal" id='myform'> $error
    
    <div class="form-group">
      <label class="control-label col-sm-2" >Username:</label>
      <div class="col-sm-10">
        <input  type='text' maxlength='16' name='user' value='$user'
      onBlur='checkUser(this)' class="form-control"  placeholder="Enter Username">
      </div> <span id='info'></span><br>
    </div>

    
    <div class="form-group">
      <label class="control-label col-sm-2" >Password:</label>
      <div class="col-sm-10">

        <input  type='password' maxlength='16' name='pass' id='pass' value='$pass' class="form-control"  placeholder="Enter Password">

      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" >Confirm Password:</label>
      <div class="col-sm-10">

        <input  type='password' maxlength='16' name='confirmpass' id='confirmpass' value='$confirmpass' class="form-control"   placeholder="Confirm Password">

      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" >Email:</label>
      <div class="col-sm-10">
        <input  type='text' maxlength='100' name='email' value='$email'  class="form-control"  placeholder="Enter Email">
      </div>
    </div>

      
    <div class="form-group">
      <label class="control-label col-sm-2" >Firstname:</label>
      <div class="col-sm-10">
        <input  type='text' maxlength='60' name='firstname' value='$firstname'
       class="form-control"  placeholder="Enter Firstname">
      </div>
    </div>
    
<div class="form-group">
      <label class="control-label col-sm-2" >Surname:</label>
      <div class="col-sm-10">
        <input  type='text' maxlength='16' name='surname' value='$surname'
     class="form-control"  placeholder="Enter Surname">
      </div>
    </div>
    <label class="control-label col-sm-2" >Gender:</label>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value= '$male' >Male</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value= '$female' >Female</label>
    </div>
    <br>

_END;


?>

<?PHP
    $male_status = 'unchecked';
    $female_status = 'unchecked';

    if (isset($_POST['gender'])) {
         $selected_radio = $_POST['gender'];

         if ($selected_radio == 'male') {
                $male_status = 'checked';
          }else if ($selected_radio == 'female') {
                $female_status = 'checked';
          }
    }
?>


    <span class='fieldname'>&nbsp;</span>
<div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" value='Sign up'  class="btn btn-default"><span class="glyphicon glyphicon-user" style="margin-right: 0.5em"></span>Create Account</button>
      </div>
    </div>
    </form>

  </div><br>

     <!--include jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"
type="text/javascript"></script>
<!--include jQuery Validation Plugin-->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"
type="text/javascript"></script>
<!--Optional: include only if you are using the extra rules in additional-methods.js -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js"
type="text/javascript"></script>
    <script type="text/javascript">$(function()
{

  $("#myform").validate({

  rules: {
    email: {
      required: true,
      email: true
    },
    confirmpass: {
                    equalTo : "#pass"
                }
  },

  messages: {

     email: 
          {
            required: "Please enter your email address. This is required to contact you later."
          },
    confirmpass: 
          {
            equalTo: "Your password confirmation does not match. Please check and try again."
          }
            }
        });
 
});</script>


  </body>
</html>
