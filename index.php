<?php // Example 26-4: index.php
  require_once 'header.php';
  include_once 'indexLocation.php';

  echo "<br><span class='main'>Welcome to $appname,";

  if ($loggedin) echo " $user, you are logged in.";
  else           echo ' please sign up and/or log in to join in.';
?>
     <div id="location"></div></br></br>
     <div id="floating-panel">
      <input id="address" type="textbox" value="Salford">
      <input id="submit" type="button" value="Search">
    </div>
     <div id='map_canvas' style= "width:900px;height:500px"></div>

    <div id='input'>

      <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div></br>

    </span><br><br>

   
  </body>
</html>
