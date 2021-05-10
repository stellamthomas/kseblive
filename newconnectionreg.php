<?php
	session_start();
	include 'connection.php';

  if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
  {

    include 'custheader.php'; ?>

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

          	<form role="form" action="connectionreg.php" method="post" enctype="multipart/form-data" name="myform">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="fname" class="form-control input-sm" placeholder="First Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lname" class="form-control input-sm" placeholder="Last Name">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address">
			    			</div>
			    			<div class="form-group">
			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address"></textarea>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number">
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
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="district">
			               					<option value="null">District</option>
			               					<option value="Idukki">Idukki</option>
			               					<option value="Kottayam">Kottayam</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      <select class="form-control bfh-states" data-country="US" data-state="CA" name="section">
                        <option value="null">Section Code</option>
                        <option value="Mundakayam [5302]">Mundakayam [5302]</option>
                        <option value="Kuttikanam [5303]">Kuttikanam [5303]</option>
                      </select>
			    					</div>
			    				</div>
			    			</div>
                <div class="form-group">
                  <input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode">
                </div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="supplytype">
			               					<option value="null">Supply Type</option>
			               					<option value="1 Phase">1 Phase</option>
			               					<option value="3 Phase">3 phase</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="totalloads" class="form-control input-sm" placeholder="Total Loads (Watts)">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="category">
			               					<option value="null">Category</option>
			               					<option value="Agriculture">Agriculture</option>
                              <option value="Commercial">Commercial</option>
                              <option value="Construction">Construction</option>
                              <option value="Domestic">Domestic</option>
                              <option value="Industrial">Industrial</option>
                              <option value="Non Commercial">Non Commercial</option>
			               			   <option value="Temporary">Temporary</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="aadhar" class="form-control input-sm" placeholder="Aadhar Number">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<label class="form-check-label" for="exampleRadios1" style="color: white;">
    Upload any address proof [.pdf/.jpg/.doc] :
  </label>
			    				<input type="file" name="aadharfile" class="form-control input-sm" >
			    			</div>


			    			<input type="submit" value="Apply" class="btn btn-info btn-block" onclick="return checkNewconn()">

			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
  }
  else
  {
	Header("location:index.php");
  }
?>