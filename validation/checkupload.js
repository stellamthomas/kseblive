
	function lastName() {
		var f2 = document.getElementById("f2");
		var lname = document.getElementById('lname').value;

		if(!/^[0-9]{1,7}$/.test(lname))
	     {
	       f2.textContent = "**Invalid Current Reading";
	       document.getElementById("lname").focus();
	       return false;
	     }
	     else
	     {
	     	f2.textContent = "";
	     	return true;
	     }
	}

	
	
	function fileCheck() {

		var f8 = document.getElementById("f8");
		var file = document.getElementById('file').value;

		var file=file.split('.').pop();
		if(file!="jpg")
	     {
	        f8.textContent = "**Select .jpg File";
	      	document.getElementById("file").focus();
	     	return false;
	     }
	     else
	     {
	     	f8.textContent = "";
	     	return true;
	     }
	}

	

function checkNewconnz() {

		if(lastName()&&fileCheck())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}