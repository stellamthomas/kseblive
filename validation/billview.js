function distPin() 
{
	var f8 = document.getElementById("f8");
	var pincode = document.getElementById('pincode').value;

	if(!/^[0-9]{13}$/.test(pincode))
     {
       f8.textContent = "**Enter Correct Consumer Number";
       document.getElementById("pincode").focus();
       return false;
     }
     else
     {
     	f8.textContent = "";
     	return true;
     }
}

function phoneUser() 
{
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

function checkAll() {

		if(distPin()&&phoneUser())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}