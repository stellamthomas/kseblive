function firstName() {
		var f1 = document.getElementById("f1");
		var fname = document.getElementById('fname').value;

		if(!/^[A-Za-z ]{5,16}$/.test(fname))
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
		var f3 = document.getElementById("f3");
		var address = document.getElementById('address').value;

		if (!/^[#.0-9a-zA-Z\s,-]{8,50}$/.test(address))
	     {
	       f3.textContent = "**Invalid Address Format";
	       document.getElementById("address").focus();
	       return false;
	     }
	     else
	     {
	     	f3.textContent = "";
	     	return true;
	     }
	}

	function emailUser() {
		var f4 = document.getElementById("f4");
		var email = document.getElementById('email').value;

		if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(email))
	     {
	       f4.textContent = "**Invalid Email Format";
	       document.getElementById("email").focus();
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

		var f6 = document.getElementById("f6");
		var district = document.getElementById('district').value;

		if(district=="null")
	     {
	       f6.textContent = "**Select any District";
	       document.getElementById("district").focus();
	       return false;
	     }
	     else
	     {
	     	f6.textContent = "";
	     	return true;
	     }
	}

	function sectionUser() {

		var f6s = document.getElementById("f6s");
		var districts = document.getElementById('districts').value;

		if(districts=="null")
	     {
	       f6s.textContent = "**Select any Nearest Section";
	       document.getElementById("districts").focus();
	       return false;
	     }
	     else
	     {
	     	f6s.textContent = "";
	     	return true;
	     }
	}


	function distPin() {

		var f7 = document.getElementById("f7");
		var pincode = document.getElementById('pincode').value;

		if(!/^[0-9]{6}$/.test(pincode))
	     {
	       f7.textContent = "**Enter Correct Pincode";
	       document.getElementById("pincode").focus();
	       return false;
	     }
	     else
	     {
	     	f7.textContent = "";
	     	return true;
	     }
	}


function checkNewconn() {

		if(firstName()&&lastName()&&emailUser()&&addrUser()&&phoneUser()&&distUser()&&sectionUser()&&distPin())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}