<!doctype html>
<html>
<head>
<title>
</title>
<!-- jQuery client-side validation -->
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
</head>

<body>

<?php // Example 26-5: signup.php
  require_once 'header.php';

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
  <div class='main'><h3>Please enter your details to sign up</h3>
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
        die("<h4>Account created</h4>Please Log in.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='signup.php' form id='myform'> $error
    
    <span class='fieldname'>Username</span>
    <input type='text' maxlength='16' name='user' value='$user'
      onBlur='checkUser(this)'><span id='info'></span><br>
  
    <span class='fieldname'>Password</span>
    <input type='text' maxlength='16' name='pass'
      value='$pass'><br>
      
    <span class='fieldname'>Email</span>
    <input type='text' maxlength='60' name='email'
      value='$email'><br>
      
      <br>
      
    <span class='fieldname'>Firstname</span>
    <input type='text' maxlength='60' name='firstname'
    value='$firstname'><br>
    
    <span class='fieldname'>Surname</span>
    <input type='text' maxlength='60' name='surname'
    value='$surname'><br>
    
    <FORM name ="form1" method ="post" action ="radioButton.php">
   <Input type = 'Radio' Name ='gender' value= '$male'
   <?PHP print $male_status; ?>
   Male
   <Input type = 'Radio' Name ='gender' value= '$female' 
   <?PHP print $female_status; ?>
   Female
    
    <br>

_END;


?>

<?PHP
    $male_status = 'unchecked';
    $female_status = 'unchecked';

    if (isset($_POST['Submit1'])) {
         $selected_radio = $_POST['gender'];

         if ($selected_radio == 'male') {
                $male_status = 'checked';
          }else if ($selected_radio == 'female') {
                $female_status = 'checked';
          }
    }
?>


    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='Sign up'>
    </form></div><br>
    
    <script>
$(document).ready(function(){ 

 $("#myform").validate({

  rules: {
    email: {
      required: true,
      email: true
    } 
  },

  messages: {

    email: "Please enter a valid email address"
            },
            submitHandler: submitForm
        });
 });

function submitForm (){
  form.submit();
}
</script>
  </body>
</html>
