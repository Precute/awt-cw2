var watchId;
var lat;
var long;
var latLong;
var uMaps;
function getPosition(){
		if (navigator.geolocation){
			navigator.geolocation.getCurrentPosition(successPosition, failPosition, {
				enableHighAccuracy : false,
				timeout:10000,
				maximumAge: 4000
				//positionOptions.enableHighAccuracy: false			
			});
		}else{
			document.getElementById("result").innerHTML = "Your browser does not support HTMLS Golocation API";
		}
	}
	function watchPosition(){
		if (navigator.geolocation){
			watchId = navigator.geolocation.watchPosition(successCallback, failPosition, {
				enableHighAccuracy : false,
				timeout:10000,
				maximumAge: 4000
				//positionOptions.enableHighAccuracy: false			
			});
		}else{
			document.getElementById("result").innerHTML = "Your browser does not support HTMLS Golocation API";
		}

	}
	function clearPosition(){
		navigator.geolocation.clearWatch(watchId);
		document.getElementById("result").innerHTML = " ";
		alert("Your location Tracker is Stopped");

	}
	
	function successPosition(position){
		lat = position.coords.latitude;
		long = position.coords.longitude
		var acc = position.coords.accuracy
		var accAlt = position.coords.altitudeAccuracy
		var alt = position.coords.altitude
		var speed = position.coords.speed
		var dir = position.coords.heading
		var date = new Date(position.timestamp);
		var hours = date.getHours();
		var minutes = date.getMinutes();
		var seconds = date.getSeconds();
        var ampm = "AM"
        if (minutes<10){
        	minutes = "0" + minutes;
        } if (hours>12){
        	hours = hours - 12
        }if (hours<=9){
        	hours = "0" + hours;
        } if (hours<=12){
        	ampm = "PM";
        }if (seconds < 10){
        	seconds = "0"+seconds;
        }
        latLong = lat +"," +long
		uMaps = "https://maps.googleapis.com/maps/api/staticmap?center="+latLong+"&zoom=16&size=6400x500&maptype=roadmap&key=AIzaSyApczdYj25JGm98yRR7a2YRBIOZH5vHDxI";
		
		if (document.getElementById("mymap") == null && document.getElementById("result") == null ) {
			var mapOption ={
				center: new google.maps.LatLng(lat, long),
				zoom: 18,
				mapType: google.maps.MapTypeId.ROADMAP,
				fullscreenControl: true
			};

		var map = new google.maps.Map(document.getElementById("interactivemap"), mapOption)
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng(lat, long),
			map: map,
			title: "My Current Location",
			animation: google.maps.Animation.DROP

		});
		var info = new google.maps.InfoWindow({
			content: "My location Info"
		});
		google.maps.event.addListener(marker, "click", function(){
			info.open(map, marker);
		})

		}
		if (document.getElementById("mymap") == null) {

			document.getElementById("result").innerHTML ="Your current location coordinates are : <br/> Longitude = "+ 	long + " <br/>Latitude = " + lat + "<br/>  Altitude = "+ alt+ "<br/> Accuracy = "+ acc+ "<br/>  Accuracy Altitude = " + accAlt+ "<br/> Direction = " +dir+ "<br/> Speed = "+ speed +"<br/> Timestamp = "+ position.timestamp+  "<br/> We collected location information at " + hours + ":" + minutes + ":"+ seconds+" " + ampm;
		}
		else{
			document.getElementById("mymap").innerHTML = "<img src='" +uMaps+"'>";
		}
		
		
	}

	function successCallback(watch){
		lat = watch.coords.latitude;
		long = watch.coords.longitude
		document.getElementById("result").innerHTML ="Your current location coordinates are : <br/> Longitude = "+ 	long + " <br/>Latitude = " + lat ;

	}
	function failPosition(error){
		var errorCode;
		if ( error.code == 1){
			errorCode = "Your Location Permission have Denied";
		}else if ( error.code == 2){
			errorCode = "Network is down, or positioning satellites uncontactable";
		}else if ( error.code == 3){
			errorCode ="finding your position takes too long";
		}else if ( error.code == 3){
			errorCode ="Something else has gone wrong";
		}

		alert("Error code: " +errorCode+ " Error message: " + error.message);

	}
	function showMap(){

			lat = 47.5952;
			long = -122.3316;
			latLong = lat +"," +long
			uMaps = "https://maps.googleapis.com/maps/api/staticmap?center="+latLong+"&zoom=16&size=6400x500&maptype=hybrid&key=AIzaSyApczdYj25JGm98yRR7a2YRBIOZH5vHDxI";
			
			document.getElementById("staticmap").innerHTML= "<img src='" +uMaps+"'>";       
		}

	function mymap(thisMap){
		lat = thisMap.coords.latitude
		long = thisMap.coords.longitude
		document.getElementById("mymap").innerHTML="Lat" + lat + "lONG" + long;
	}
	function start(){
		showMap();
		getPosition();
	}
	function interactivemaps(){
		getPosition();
	}
	function interactivemap(){
		var mapOption ={
			center: new google.maps.LatLng(47.5952, -122.3316),
			zoom: 18,
			mapType: google.maps.MapTypeId.ROADMAP,
			fullscreenControl: true
		};

		var map = new google.maps.Map(document.getElementById("interactivemap"), mapOption)
	}
	