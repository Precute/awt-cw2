<?php
 

$dbhost  = 'mudfoot.doc.stu.mmu.ac.uk';    // Unlikely to require changing
  $dbname  = 'arpalikh';   // Modify these...
  $dbuser  = 'arpalikh';   // ...variables according
  $dbpass  = 'Vanscerq9';   // ...to your installation
  $appname = "Robin's Nest"; // ...and preference


  //$dbhost = ; // the database host
//$dbuser = 'igbinoso' ; 
//$dbpass = 'jesSplam6' ; // password

//$dbhost = 'mysql:host=127.0.0.1;dbname=test';
//$dbname = 'root';
//$dbpass = 'password';

  $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
     
 
        //Initialize your first couple variables
        $encodedString = ""; //This is the string that will hold all your location data
        $x = 0; //This is a trigger to keep the string tidy
 
        //Now we do a simple query to the database
        $result = mysqli_query($connection,"SELECT * FROM track_location");
 
        //Multiple rows are returned
        while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            //This is to keep an empty first or last line from forming, when the string is split
            if ( $x == 0 )
            {
                 $separator = "";
            }
            else
            {
                 //Each row in the database is separated in the string by four *'s
                 $separator = "****";
            }
            //Saving to the String, each variable is separated by three &'s
            $encodedString = $encodedString.$separator.
            "<p class='content'><b>Lat:</b> ".$row[2].
            "<br><b>Longi:</b> ".$row[1].
            "</p>&&&".$row[2]."&&&".$row[1];
            $x = $x + 1;
        }        
?>