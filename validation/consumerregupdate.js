function firstName() {
		var f1 = document.getElementById("f1");
		var fname = document.getElementById('fname').value;

		if(!/^[A-Za-z ]{3,16}$/.test(fname))
	     {
	       f1.textContent = "**Invalid First Name";
	       var x = document.getElementById("fname");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f1.textContent = "";
	     	return true;
	     }
	}

	function lastName() {
		var f2 = document.getElementById("f2");
		var lname = document.getElementById('lname').value;

		if(!/^[A-Za-z ]{1,16}$/.test(lname))
	     {
	       f2.textContent = "**Invalid Last Name";
	       document.getElementById("lname").focus();
	       return false;
	     }
	     else
	     {
	     	f2.textContent = "";
	     	return true;
	     }
	}


	function addrUser() {
		var f4 = document.getElementById("f4");
		var address = document.getElementById('address').value;

		if (!/^[#.0-9a-zA-Z\s,-]{8,50}$/.test(address))
	     {
	       f4.textContent = "**Invalid Address Format";
	       document.getElementById("address").focus();
	       return false;
	     }
	     else
	     {
	     	f4.textContent = "";
	     	return true;
	     }
	}

	function phoneUser() {
		var f5 = document.getElementById("f5");
		var phone = document.getElementById('phone').value;

		if(!/^[6-9]{1}[0-9]{9}$/.test(phone))
	     {
	       f5.textContent = "**Invalid Phone # Format";
	       document.getElementById("phone").focus();
	       return false;
	     }
	     else
	     {
	     	f5.textContent = "";
	     	return true;
	     }
	}

	

	function distUser() {

		var f7 = document.getElementById("f7");
		var district = document.getElementById('district').value;

		if(district=="null")
	     {
	       f7.textContent = "**Select any District";
	       document.getElementById("district").focus();
	       return false;
	     }
	     else
	     {
	     	f7.textContent = "";
	     	return true;
	     }
	}

	function distPin() {

		var f8 = document.getElementById("f8");
		var pincode = document.getElementById('pincode').value;

		if(!/^[0-9]{6}$/.test(pincode))
	     {
	       f8.textContent = "**Enter Correct Pincode";
	       document.getElementById("pincode").focus();
	       return false;
	     }
	     else
	     {
	     	f8.textContent = "";
	     	return true;
	     }
	}

	

	function checkAllwww() {

		if(firstName()&&lastName()&&addrUser()&&phoneUser()&&distUser()&&distPin())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}