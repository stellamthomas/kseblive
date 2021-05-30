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

	function rtnUser() {

		var f67 = document.getElementById("f67");
		var district7 = document.getElementById('district7').value;

		if(district7=="null")
	     {
	       f67.textContent = "**Select any Ration Card";
	       document.getElementById("district7").focus();
	       return false;
	     }
	     else
	     {
	     	f67.textContent = "";
	     	return true;
	     }
	}

	function panchName() {
		var f12 = document.getElementById("f12");
		var fname2 = document.getElementById('fname2').value;

		if(!/^[A-Za-z ]{5,16}$/.test(fname2))
	     {
	       f12.textContent = "**Invalid Panchayat Name";
	       var x = document.getElementById("fname2");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f12.textContent = "";
	     	return true;
	     }
	}

	function panchName1() {
		var f129 = document.getElementById("f129");
		var fname21 = document.getElementById('fname21').value;

		if(!/^[A-Za-z ]{5,16}$/.test(fname21))
	     {
	       f129.textContent = "**Invalid Village Name";
	       var x = document.getElementById("fname21");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f129.textContent = "";
	     	return true;
	     }
	}

	function panchName2() {
		var f122 = document.getElementById("f122");
		var fname22 = document.getElementById('fname22').value;

		if(!/^[0-9]{1,2}$/.test(fname22))
	     {
	       f122.textContent = "**Invalid Ward Number";
	       var x = document.getElementById("fname22");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f122.textContent = "";
	     	return true;
	     }
	}

	function panchName3() {
		var f123 = document.getElementById("f123");
		var fname23 = document.getElementById('fname23').value;

		if(!/^[0-9]{1,2}$/.test(fname23))
	     {
	       f123.textContent = "**Invalid House Number";
	       var x = document.getElementById("fname23");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f123.textContent = "";
	     	return true;
	     }
	}

	function panchName4() {
		var f124 = document.getElementById("f124");
		var fname24 = document.getElementById('fname24').value;

		if(!/^[A-Za-z ]{5,16}$/.test(fname24))
	     {
	       f124.textContent = "**Invalid Taluk Name";
	       var x = document.getElementById("fname24");
	       x.focus();
	       return false;
	     }
	     else
	     {
	     	f124.textContent = "";
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

	function supplyUser() {

		var f6sup = document.getElementById("f6sup");
		var districtsup = document.getElementById('districtsup').value;

		if(districtsup=="null")
	     {
	       f6sup.textContent = "**Select any Supply Type";
	       document.getElementById("districtsup").focus();
	       return false;
	     }
	     else
	     {
	     	f6sup.textContent = "";
	     	return true;
	     }
	}

	function totUser() {
		var t1 = document.getElementById("t1");
		var totloads = document.getElementById('totloads').value;

		if(totloads=="null")
	     {
	       t1.textContent = "**Select any Total Loads";
	       document.getElementById("totloads").focus();
	       return false;
	     }
	     else
	     {
	     	t1.textContent = "";
	     	return true;
	     }
	}


function categoryUser() {

		var f6cat = document.getElementById("f6cat");
		var districtcat = document.getElementById('districtcat').value;

		if(districtcat=="null")
	     {
	       f6cat.textContent = "**Select any Category";
	       document.getElementById("districtcat").focus();
	       return false;
	     }
	     else
	     {
	     	f6cat.textContent = "";
	     	return true;
	     }
	}

	function aadharCheck() {
		var aad = document.getElementById("aad");
		var aadhar = document.getElementById('aadhar').value;

		if(!/^[0-9]{12}$/.test(aadhar))
	     {
	       aad.textContent = "**Enter Valid Aadhar Number";
	       document.getElementById("aadhar").focus();
	       return false;
	     }
	     else
	     {
	     	aad.textContent = "";
	     	return true;
	     }
	}


	function fileCheck() {

		var f8 = document.getElementById("f8");
		var file = document.getElementById('file').value;

		var file=file.split('.').pop();
		if(file!="pdf")
	     {
	        f8.textContent = "**Select PDF File";
	      	document.getElementById("file").focus();
	     	return false;
	     }
	     else
	     {
	     	f8.textContent = "";
	     	return true;
	     }
	}

	

function checkNewconn() {

		if(firstName()&&lastName()&&emailUser()&&addrUser()&&phoneUser()&&rtnUser()&&panchName()&&panchName1()&&panchName2()&&panchName3()&&panchName4()&&distUser()&&sectionUser()&&distPin()&&supplyUser()&&totUser()&&categoryUser()&&aadharCheck()&&fileCheck())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}