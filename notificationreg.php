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
   <h1 style="font-size: 25px;padding-top: 110px;margin-left: 860px;">Post Notification</h1>
    <form action="/action_page.php" style="margin-top: 60px;">
        <select name="district" class="textb" style="margin-left: 620px;">
            <option value="">------------------------- User Type -------------------------</option>
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
        <input  class="textb" type="text" name="sub" placeholder="Subject" style="margin-left: 0px;">

        

        <textarea rows="10" cols="25" name="notify" class="textb" style="margin-left: 620px;width: 34.2%;" placeholder="Enter your notification description here..."></textarea>

        <input class="sub"  type="submit" value="Upload Notification">
    </form>

    <div class="counter01" style="margin-top: 386px;">
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