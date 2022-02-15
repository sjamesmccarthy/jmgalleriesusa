<script>
	var dt = new Date();
	//  dt.setHours( dt.getHours() + 2 );
	function getCookie(name) {
		// Split cookie string and get all individual name=value pairs in an array
		var cookieArr = document.cookie.split(";");
		// Loop through the array elements
		for(var i = 0; i < cookieArr.length; i++) {
		var cookiePair = cookieArr[i].split("=");
			/* Removing whitespace at the beginning of the cookie name
			and compare it with the given string */
			if(name == cookiePair[0].trim()) {
			// Decode the cookie value and return
			return decodeURIComponent(cookiePair[1]);
			}
		}
		return null;
	}

	function updateMcCookie(currentTime) {
		var expiryTime = currentTime + 24 * 60 * 60 * 1000; //ExpiryTime for 24 hours from current time in miliseconds
		dt.setTime(expiryTime);
		localStorage.setItem('MCPopupClosed', expiryTime)
		document.cookie = 'MCPopupClosed=yes;path=/;expires=' + dt;
	}

	function mcPopupCookie() {
		var mcCookie = getCookie("MCPopupClosed");
		// Get cookie using our custom function
		var dt = new Date();
		var currentTime = dt.getTime(); //Current Time in miliseconds
		var popupExpiryDate = localStorage.getItem('MCPopupClosed');
	   // console.log(popupExpiryDate);
		if((popupExpiryDate!=null) &&  popupExpiryDate < currentTime) {
			localStorage.removeItem('MCPopupClosed');
			document.cookie = 'MCPopupClosed=yes;path=/;expires=Thu, 01 Jan 1970 00:00:00 UTC;';
		} else {

			if (mcCookie) {
				if (popupExpiryDate && popupExpiryDate > currentTime) {
				} else {
					updateMcCookie(currentTime);
				}
			} else {
				//Remove the localStorage MCPopupClosed if there is no MCPopupClosed
				localStorage.removeItem('MCPopupClosed');
			}
		}
	}
	mcPopupCookie();
</script>