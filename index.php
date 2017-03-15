<?php // Example 26-4: index.php
  require_once 'header.php';
  include_once 'indexLocation.php';


?>
<div class="jumbotron">
<?php

  echo "<h1>Welcome to $appname!!!</h1>" ;
?>

  <?php
  if ($loggedin) echo " <p>$user, you are logged in.</>";
  else           echo ' <p>please sign up and/or log in to join in.</p>';
?>
  <p><a class="btn btn-primary btn-lg" href="login.php" role="button">Connect with the People around You!!</a></p>

</div>

     <div id="location"></div></br></br>
     <div id="floating-panel">
      <input id="address" type="textbox" value="Salford">
      <input id="submit" type="button" value="Search">
    </div>
     <div id='map_canvas' style= "width:100%;height:500px"></div>

    <div id='input'>

      <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div></br>

    </span><br><br>

   
  </body>


</html>
</html>
