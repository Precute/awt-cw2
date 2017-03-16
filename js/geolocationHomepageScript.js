//Initialize the Google Maps
var watchId;
var lat;
var long;
var latLong, startLat, startLong;
var uMaps;
var geocoder;
var start = 1;
var markerTitle;


function getCurrentPosition() {
    if (geoPosition.init()) {
        geoPosition.getCurrentPosition(successCallback, failPosition, {
            enableHighAccuracy: true,
            timeout: 5 * 60 * 10000,
            maximumAge: 60 * 000
                //positionOptions.enableHighAccuracy: false         
        });
    } else {
        document.getElementById("location").innerHTML = "Your browser does not support HTMLS Golocation API";
    }

}

function clearPosition() {
    navigator.geolocation.clearWatch(watchId);
    document.getElementById("location").innerHTML = " ";
    alert("Your location Tracker is Stopped");

}

function successCallback(watch) {
    lat = watch.coords.latitude;
    long = watch.coords.longitude;
 var dataForm = 'lat=' + lat + '&long=' + long;

         $.ajax({
            url: 'sendcoords.php',
            data: dataForm,
            type: "POST",
            success: function(json) {
                //alert("and again");
                }
            }); 

    var locationAddress, locationAddress2;
    if (start == 1) {
        startLat = lat;
        startLong = long;
        start = 1;
    };
    geocoder = new google.maps.Geocoder();
    latLong = new google.maps.LatLng(lat, long);
    geocoder.geocode({
        'latLng': latLong
    }, 
    function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results) {
                locationAddress = results[0].formatted_address;
                locationAddress2 = results[1].formatted_address;
                var markerTitle = results[0].address_components[1].long_name;
                
                var mapOption = {
                    center: new google.maps.LatLng(startLat, startLong),
                    zoom: 14,
                    mapType: google.maps.MapTypeId.ROADMAP,
                    fullscreenControl: true
                };

                var map = new google.maps.Map(document.getElementById("showMap"), mapOption)
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(startLat, startLong),
                    map: map,
                    title: markerTitle,
                    animation: google.maps.Animation.DROP

                });
                var info = new google.maps.InfoWindow({
                    content: locationAddress
                });
                google.maps.event.addListener(marker, "click", function() {
                    info.open(map, marker);
                })

            }

        } else {
            alert("Could not get the geolocation informatiom");
        }

    });


}

function successPosition(memberPosition){


}

function failPosition(error) {
    var errorCode;
    if (error.code == 1) {
        errorCode = "Your Location Permission have Denied";
    } else if (error.code == 2) {
        errorCode = "Network is down, or positioning satellites uncontactable";
    } else if (error.code == 3) {
        errorCode = "finding your position takes too long";
    } else if (error.code == 3) {
        errorCode = "Something else has gone wrong";
    }

    alert("Error code: " + errorCode + " Error message: " + error.message);

}


      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

 //This javascript will load when the page loads.
    $(function(){
 
            
        
            var markersArray = [];
            var infos = [];
 
            var geocoder1 = new google.maps.Geocoder();
            var myOptions = {
                  zoom: 18,
                  mapTypeId: google.maps.MapTypeId.ROADMAP,
                  fullscreenControl: true
                };
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
            {   var locationAddress;
                var locationAddress2
                var addressDetails = [];
                var marker;
                //Separate each field
                addressDetails = stringArray[x].split("&&&");
                //Load the lat, long data
                var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);
                console.log('*****'  + lat);
                  geocoder1.geocode({
                        'latLng': lat
                    },function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            if (results) {
                                locationAddress = results[0].formatted_address;
                                locationAddress2 = results[1].formatted_address;
                                markerTitle = results[0].address_components[1].long_name;
                                console.log('*****'  + markerTitle);
                            }

                        } else {
                            alert("Could not get the geolocation information");
                        }

                 });
                //Create a new marker and info window
                marker = new google.maps.Marker({
                    map: map,
                    icon: {
                        path: "M27.648 -41.399q0 -3.816 -2.7 -6.516t-6.516 -2.7 -6.516 2.7 -2.7 6.516 2.7 6.516 6.516 2.7 6.516 -2.7 2.7 -6.516zm9.216 0q0 3.924 -1.188 6.444l-13.104 27.864q-0.576 1.188 -1.71 1.872t-2.43 0.684 -2.43 -0.684 -1.674 -1.872l-13.14 -27.864q-1.188 -2.52 -1.188 -6.444 0 -7.632 5.4 -13.032t13.032 -5.4 13.032 5.4 5.4 13.032z",
                        scale: 0.6,
                        strokeWeight: 0.2,
                        strokeColor: 'black',
                        strokeOpacity: 1,
                        fillColor: 'green',
                        fillOpacity: 0.85,
                    },
                    position: lat,
                    //Content is what will show up in the info window
                    content: '*****'  + lat
                });
               

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
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




