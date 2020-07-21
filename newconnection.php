<?php 
    include 'mainheader.php';
?>
<style>
.textb{
  width: 17%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-left: 300px;
  box-sizing: border-box;
}

.sub {
  width: 34.2%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  margin-top: 10px;
  margin-left: 620px;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
</style>
   <h1 style="font-size: 25px;padding-top: 110px;margin-left: 798px;">New Connection Application</h1>
    <form action="/action_page.php" style="margin-top: 60px;">
        <input  class="textb" type="text" name="firstname" placeholder="First Name" style="margin-left: 620px;">
        <input  class="textb" type="text" name="lastname" placeholder="Last Name" style="margin-left: 0px;">

        <input  class="textb" type="text" name="email" placeholder="Email Id" style="width: 34.2%;margin-left:620px;"><br>

        <textarea rows="5" cols="25" name="addr" class="textb" style="margin-left: 620px;width: 34.2%;" placeholder="Enter your address here..."></textarea><br>

        <input  class="textb" type="text" name="firstname" placeholder="Phone Number" style="margin-left: 620px;">
        <span style="margin-right: 30px;margin-left: 30px;"><b>Gender :</b></span>
            <input type="radio" name="gender" value="m" style="margin-left: 20px;" ><b>Male</b>
            <input type="radio" name="gender" value="m" style="margin-left: 50px;" ><b>Female</b><br>
        
            <select name="district" class="textb" style="margin-left: 620px;" >
                <option value="">---------------------------- District ----------------------------</option>
                <option value="tvm">Triruvananthapuram</option>
                <option value="kollam">kollam</option>
                <option value="alappuzha">Alappuzha</option>
                <option value="idukki">Pathanamthitta</option>
                <option value="kottayam">Kottayam</option>
                <option value="idukki">Idukki</option>
                <option value="Ernakulam">Ernakulam</option>
                <option value="trissur">Trissur</option>
                <option value="Palakkad">Palakkad</option>
                <option value="malappuram">Malappuram</option>
                <option value="kozhikode">Kozhikode</option>
                <option value="wayanad">Wayanad</option>
                <option value="kannur">Kannur</option>
                <option value="kasaragode">Kasaragode</option>
            </select>
        <input  class="textb" type="text" name="pincode" placeholder="Pincode" style="margin-left: 0px;">

        <select name="suptype" class="textb" style="margin-left: 620px;" >
            <option value="">------------------------- Supply Type -------------------------</option>
            <option value="tvm">Triruvananthapuram</option>
            <option value="kollam">kollam</option>
            <option value="alappuzha">Alappuzha</option>
            <option value="idukki">Pathanamthitta</option>
            <option value="kottayam">Kottayam</option>
            <option value="idukki">Idukki</option>
            <option value="Ernakulam">Ernakulam</option>
            <option value="trissur">Trissur</option>
            <option value="Palakkad">Palakkad</option>
            <option value="malappuram">Malappuram</option>
            <option value="kozhikode">Kozhikode</option>
            <option value="wayanad">Wayanad</option>
            <option value="kannur">Kannur</option>
            <option value="kasaragode">Kasaragode</option>
        </select>

        <input  class="textb" type="text" name="totload" placeholder="Total Load (Watts)" style="margin-left: 0px;"><br>

        <select name="district" class="textb" style="margin-left: 620px;" >
            <option value="">-------------------------- Category ---------------------------</option>
            <option value="tvm">Triruvananthapuram</option>
            <option value="kollam">kollam</option>
            <option value="alappuzha">Alappuzha</option>
            <option value="idukki">Pathanamthitta</option>
            <option value="kottayam">Kottayam</option>
            <option value="idukki">Idukki</option>
            <option value="Ernakulam">Ernakulam</option>
            <option value="trissur">Trissur</option>
            <option value="Palakkad">Palakkad</option>
            <option value="malappuram">Malappuram</option>
            <option value="kozhikode">Kozhikode</option>
            <option value="wayanad">Wayanad</option>
            <option value="kannur">Kannur</option>
            <option value="kasaragode">Kasaragode</option>
        </select>

        <input  class="textb" type="text" name="aadharno" placeholder="Aadhar Number" style="margin-left: 0px;"><br>
        
        <span style="margin-right: 30px;margin-left: 620px;"><b>Select aadhar card file [.pdf / .jpg] :</b></span>

        <input type="file" class="textb" name="filename" style="margin-left: 0px; width:22%; background-color:white"><br>

        <input class="sub"  type="submit" value="Apply">
    </form>


    <div class="counter01" style="margin-top: 120px;">
				<p>Visit Counter: <span id="counter" class="numcu" >139804426</span> (Since Today)</p>
			</div>
			<!-- banner end -->

			<!-- footer section start -->
			<footer class="site-footer">
				<div class="inner_wrap">	</div>
				<h4>Content owned, updated and maintained by Kerala Electricity Board, Ministry of Power,Government of Kerala.<br> KSEBLive is designed and developed by Stella M Thomas 2020 &copy;</h4>
			</footer>
		</div>
		<!-- footer section end -->	
	</body>
</html>