function startDate() {

		var s1 = document.getElementById("s1");
		var sdate = document.getElementById('sdate').value;

		if(sdate=="")
	     {
	       s1.textContent = "**Select Any Due Date";
	       document.getElementById("sdate").focus();
	       return false;
	     }
	     else
	     {
	     	s1.textContent = "";
	     	return true;
	     }
	}

	function endDate() {

		var e1 = document.getElementById("e1");
		var edate = document.getElementById('edate').value;

		if(edate=="")
	     {
	       e1.textContent = "**Select Any Disconnection Date";
	       document.getElementById("edate").focus();
	       return false;
	     }
	     else
	     {
	     	e1.textContent = "";
	     	return true;
	     }
	}

	function totTravel() {

		var top2 = document.getElementById("top2");
		var tot = document.getElementById('tot').value;

		if(!/^[0-9]{1,5}$/.test(tot))
	     {
	       top2.textContent = "**Enter Correct Last Reading";
	       document.getElementById("tot").focus();
	       return false;
	     }
	     else
	     {
	     	top2.textContent = "";
	     	return true;
	     }
	}

	function totTravel1() {

		var top21 = document.getElementById("top21");
		var tot1 = document.getElementById('tot1').value;

		if(!/^[0-9]{1,5}$/.test(tot1))
	     {
	       top21.textContent = "**Enter Correct Final Reading";
	       document.getElementById("tot1").focus();
	       return false;
	     }
	     else
	     {
	     	top21.textContent = "";
	     	return true;
	     }
	}

	function totTravel2() {

		var top22 = document.getElementById("top22");
		var tot2 = document.getElementById('tot2').value;

		if(!/^[0-9.]{1,8}$/.test(tot2))
	     {
	       top22.textContent = "**Enter Correct Fixed Charge";
	       document.getElementById("tot2").focus();
	       return false;
	     }
	     else
	     {
	     	top22.textContent = "";
	     	return true;
	     }
	}

	function totTravel3() {

		var top23 = document.getElementById("top23");
		var tot3 = document.getElementById('tot3').value;

		if(!/^[0-9.]{1,8}$/.test(tot3))
	     {
	       top23.textContent = "**Enter Correct Energy Charge";
	       document.getElementById("tot3").focus();
	       return false;
	     }
	     else
	     {
	     	top23.textContent = "";
	     	return true;
	     }
	}

	function checkAlls(){
		if(startDate()&&endDate()&&totTravel()&&totTravel1()&&totTravel2()&&totTravel3())
	     {
	       return true;
	     }
	     else
	     {
	     	return false;
	     }
	}