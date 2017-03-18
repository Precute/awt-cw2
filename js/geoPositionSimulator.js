var geoPositionSimulator=function(){
	var pub = {};
	var currentPosition=null;
	/*
	* Example:
	* array = [ { coords: {
	*						latitude: 	30.293095,
	*						longitude: 	-97.5763955
	*						}
	*			}]	
	*
	*/
	pub.init = function(array)
	{
		var next=0;
		for (i in array)
		{
				if( i == 0 )
				{
					currentPosition=array[i];
				}
				else
				{
					setTimeout((function(pos) { 
					      return function() { 
					        currentPosition=pos; 									
					      } 
					    })(array[i]),next);
				}
				next+=array[i].duration;							
		}
	}

	pub.getCurrentPosition = function(locationCallback,errorCallback)
	{
		locationCallback(currentPosition);
	}
	return pub;
}();