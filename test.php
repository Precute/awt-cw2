<html>
    <head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
    <style>
 
        BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }
 
        #map_canvas { width:100%; height: 100%; z-index: 0; }
    </style>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyApczdYj25JGm98yRR7a2YRBIOZH5vHDxI" /></script>
    <script type='text/javascript'>
 
    //This javascript will load when the page loads.
    jQuery(document).ready(function($){
 
            //Initialize the Google Maps
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];
 
            geocoder = new google.maps.Geocoder();
            var myOptions = {
                  zoom: 12,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            //Load the Map into the map_canvas div
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
            //Initialize a variable that the auto-size the map to whatever you are plotting
            var bounds = new google.maps.LatLngBounds();
            //Initialize the encoded string       
            var encodedString;
            //Initialize the array that will hold the contents of the split string
            var stringArray = [];
            //Get the value of the encoded string from the hidden input
            encodedString = document.getElementById("encodedString").value;
            //Split the encoded string into an array the separates each location
            stringArray = encodedString.split("****");
 
            var x;
            for (x = 0; x < stringArray.length; x = x + 1)
            {
                var addressDetails = [];
                var marker;
                //Separate each field
                addressDetails = stringArray[x].split("&&&");
                //Load the lat, long data
                var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
                //Create a new marker and info window
                marker = new google.maps.Marker({
                    map: map,
                    position: lat,
                    //Content is what will show up in the info window
                    content: addressDetails[0]
                });
                //Pushing the markers into an array so that it's easier to manage them
                markersArray.push(marker);
                google.maps.event.addListener( marker, 'click', function () {
                    closeInfos();
                    var info = new google.maps.InfoWindow({content: this.content});
                    //On click the map will load the info window
                    info.open(map,this);
                    infos[0]=info;
                });
               //Extends the boundaries of the map to include this new location
               bounds.extend(lat);
            }
            //Takes all the lat, longs in the bounds variable and autosizes the map
            map.fitBounds(bounds);
 
            //Manages the info windows
            function closeInfos(){
           if(infos.length > 0){
              infos[0].set("marker",null);
              infos[0].close();
              infos.length = 0;
           }
            }
 
    });
    </script>
 
    </head>
    <body style= "width:100%;height:100%">
    <div id='map_canvas' style= "width:100%;height:100%"></div>
    <div id='input'>
 
<?php
 
        //Connect to the MySQL database that is holding your data, replace the x's with your data
          $dbhost  = 'mudfoot.doc.stu.mmu.ac.uk' ;    // Unlikely to require changing
  $dbname  = 'igbinoso';   // Modify these...
  $dbuser  = 'igbinoso';   // ...variables according
  $dbpass  = 'jesSplam6';   // ...to your installation
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
        $result = mysqli_query($connection,"SELECT * FROM big_ten");
 
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
            "<p class='content'><b>Lat:</b> ".$row[1].
            "<br><b>Longi:</b> ".$row[2].
            "<br><b>Name: </b>".$row[3].
            "<br><b>Address: </b>".$row[4].
            "<br><b>Division: </b>".$row[5].
            "</p>&&&".$row[1]."&&&".$row[2];
            $x = $x + 1;
        }        
        ?>
 
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div></br>
    
    </body>
</html>