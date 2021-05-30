function distPin() {

		var f7 = document.getElementById("f7");
		var key = document.getElementById('key').value;

		if(!/^[0-9a-zA-Z]{8}$/.test(key))
	     {
	       f7.textContent = "**Enter 8 Digit Correct OTP";
	       document.getElementById("key").focus();
	       return false;
	     }
	     else
	     {
	     	f7.textContent = "";
	     	return true;
	     }
	}

	function checkAll() {

		if(distPin())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}