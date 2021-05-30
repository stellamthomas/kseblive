function addrUser() {
		var f3 = document.getElementById("f3");
		var address = document.getElementById('address').value;

		if (!/^[#.0-9a-zA-Z\s,-]{15,100}$/.test(address))
	     {
	       f3.textContent = "**Invalid Feedback - 15 Characters Minimum";
	       document.getElementById("address").focus();
	       return false;
	     }
	     else
	     {
	     	f3.textContent = "";
	     	return true;
	     }
	}
function checkNewconn() {

		if(addrUser())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	  	}
	 }