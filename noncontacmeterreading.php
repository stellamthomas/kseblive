<?php
    include 'mainheader.php'; ?>
    <script src="validation/checkconn.js"></script>
      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/bbb.jpg);"></div>

      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">New Connection - Apply Online</h2>
          <div class="col-md-8 col-lg-7">

          	<form role="form" name="myform" action="publicconnectionreg.php" method="post" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="fname" class="form-control input-sm" placeholder="First Name" id="fname" onkeyup="firstName()">
									<span style="color: red;font-size: 14px" id="f1"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lname" class="form-control input-sm" placeholder="Last Name" id="lname" onkeyup="lastName()">
									<span style="color: red;font-size: 14px" id="f2"></span>
			    					</div>
			    				</div>
			    			</div>



			    			<div class="form-group">
			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address" id="email" onkeyup="emailUser()">
							<span style="color: red;font-size: 14px" id="f4"></span>
			    			</div>
			    			<div class="form-group">
			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address" id="address" onkeyup="addrUser()"></textarea>
							<span style="color: red;font-size: 14px" id="f3"></span>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" id="phone" onkeyup="phoneUser()">
									<span style="color: red;font-size: 14px" id="f5"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<div class="form-check"><label class="form-check-input" for="exampleRadios1" style="color: white;font-weight: bold;">Gender</label><br>
  <input class="form-check-input" type="radio" name="gender" value="Male" checked>
  <label class="form-check-label" for="exampleRadios1" style="color: white;">
    Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </label>

  <input class="form-check-input" type="radio" name="gender" value="Female">
  <label class="form-check-label" for="exampleRadios2" style="color: white;">
    Female
  </label>
</div>
			    					</div>
			    				</div>
			    			</div>
<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control" data-country="US" data-state="CA" name="rtncard" id="district7" onclick="rtnUser()">
			               					<option value="null">Ration Card</option>
			               					<option value="APL">APL</option>
			               					<option value="BPL">BPL</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f67"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="pnch" class="form-control input-sm" placeholder="Panchayat" id="fname2" onkeyup="panchName()">
									<span style="color: red;font-size: 14px" id="f12"></span>
			    					</div>
			    				</div>
			    			</div>

							<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="vlg" class="form-control input-sm" placeholder="Village" id="fname21" 
			    						onkeyup="panchName1()">
									<span style="color: red;font-size: 14px" id="f129"></span>
			               				
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="ward"  class="form-control input-sm" placeholder="Ward" id="fname22" 
			    						onkeyup="panchName2()">
									<span style="color: red;font-size: 14px" id="f122"></span>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="hno" class="form-control input-sm" placeholder="House #" id="fname23" 
			               				onkeyup="panchName3()">
									<span style="color: red;font-size: 14px" id="f123"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="tlk" class="form-control input-sm" placeholder="Taluk" id="fname24" 
			    						onkeyup="panchName4()">
									<span style="color: red;font-size: 14px" id="f124"></span>
			    					</div>
			    				</div>
			    			</div>

			    			


			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="district" id="district" onclick="distUser()">
			               					<option value="null">District</option>
			               					<option value="Idukki">Idukki</option>
			               					<option value="Kottayam">Kottayam</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      <select class="form-control bfh-states" data-country="US" data-state="CA" name="section" id="districts" onclick="sectionUser()">
                        <option value="null">Section Code</option>
                        <option value="Mundakayam [5302]">Mundakayam [5302]</option>
                        <option value="Kuttikanam [5303]">Kuttikanam [5303]</option>
                      </select>
                      <span style="color: red;font-size: 14px" id="f6s"></span>
			    					</div>
			    				</div>
			    			</div>


                <div class="form-group">
                  <input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" id="pincode" onkeyup="distPin()">
									<span style="color: red;font-size: 14px" id="f7"></span>
                </div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="supplytype" id="districtsup" onclick="supplyUser()">
			               					<option value="null">Supply Type</option>
			               					<option value="1 Phase">1 Phase</option>
			               					<option value="3 Phase">3 phase</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6sup"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<select class="form-control" data-country="US" data-state="CA" name="totalloads" id="totloads" 
			    						onclick="totUser()">
			               					<option value="null">Total Loads</option>
			               					<option value="1200">1200 Watts</option>
			               					<option value="2200">2200 Watts</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="t1"></span>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="category" id="districtcat" onclick="categoryUser()">
			               					<option value="null">Category</option>
			               					<option value="Agriculture">Agriculture</option>
                              <option value="Commercial">Commercial</option>
                              <option value="Construction">Construction</option>
                              <option value="Domestic">Domestic</option>
                              <option value="Industrial">Industrial</option>
                              <option value="Non Commercial">Non Commercial</option>
			               			   <option value="Temporary">Temporary</option>
			               				</select>
			               				<span style="color: red;font-size: 14px" id="f6cat"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="aadhar" class="form-control input-sm" placeholder="Aadhar Number" id="aadhar" 
			    						onkeyup="aadharCheck()">
								<span style="color: red;font-size: 14px" id="aad"></span>
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<label class="form-check-label" for="exampleRadios1" style="color: white;">
    Upload any address proof [.pdf] :
  </label>
			    				<input type="file" name="aadharfile" class="form-control input-sm" id="file" onchange="fileCheck()">
							<span style="color: red;font-size: 14px" id="f8"></span>
			    			</div>


			    			<input type="submit" value="Apply" class="btn btn-info btn-block" onclick="return checkNewconn()" >

			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>
