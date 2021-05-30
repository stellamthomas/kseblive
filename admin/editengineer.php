<?php
  include 'connection.php';
  include 'adminheader.php';

  $sql = "select * from tb_engineerreg inner join tb_login where tb_login.id=tb_engineerreg.loginid and tb_engineerreg.engkey='".$_GET['t']."'";
  $result = mysqli_query($conn,$sql);
?>
    <script src="../validation/ksebengineer.js"></script>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Update KSEB Engineer</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Registration Form</h6>
                        </div>
                        <div class="card-body" >

                          <?php while ($row=mysqli_fetch_array($result))
                          {  ?>
                          <form role="form" action="updateengineerreg.php?t=<?php echo $_GET['t']; ?>" method="post" enctype="multipart/form-data">
              			    			<div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			               				<input type="text" name="fname" class="form-control input-sm" placeholder="First Name" value="<?php echo $row['fname']; ?>" id="fname" onkeyup="firstName()">
                  <span style="color: red;font-size: 14px" id="f1"></span>

              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			    						<input type="text" name="lname" class="form-control input-sm" placeholder="Last Name" value="<?php echo $row['lname']; ?>" id="lname" onkeyup="lastName()">
                  <span style="color: red;font-size: 14px" id="f2"></span>

              			    					</div>
              			    				</div>
              			    			</div>

              			    			<div class="form-group">
              			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address" value="<?php echo $row['username']; ?>" readonly id="email" onkeyup="emailUser()">
              <span style="color: red;font-size: 14px" id="f4"></span>

              			    			</div>
              			    			<div class="form-group">
              			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address" id="address" onkeyup="addrUser()"><?php echo $row['address']; ?></textarea>
              			    			</div></textarea>
              <span style="color: red;font-size: 14px" id="f3"></span>

              			    			<div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" value="<?php echo $row['phno']; ?>" id="phone" onkeyup="phoneUser()">
                                          <span style="color: red;font-size: 14px" id="f5"></span>

              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			    						<div class="form-check"><label class="form-check-input" for="exampleRadios1" style="color: Gender;font-weight: bold;">Gender</label><br>
                <input class="form-check-input" type="radio" name="gender" value="Male" <?=$row['gender'] == 'Male' ? ' checked ' : '';?>>
                <label class="form-check-label" for="exampleRadios1" style="color: grey;">
                  Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </label>

                <input class="form-check-input" type="radio" name="gender" value="Female" <?=$row['gender'] == 'Female' ? ' checked ' : '';?>>
                <label class="form-check-label" for="exampleRadios2" style="color: grey;">
                  Female
                </label>
              </div>
              			    					</div>
              			    				</div>
              			    			</div>

                              <div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
              			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="district" id="district" onclick="distUser()">
              			               					<option value="null">District</option>
              			               					<option value="Idukki" <?=$row['district'] == 'Idukki' ? ' selected="selected"' : '';?>>Idukki</option>
              			               					<option value="Kottayam" <?=$row['district'] == 'Kottayam' ? ' selected="selected"' : '';?>>Kottayam</option>
              			               				</select>
                                          <span style="color: red;font-size: 14px" id="f6"></span>
              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <select class="form-control bfh-states" data-country="US" data-state="CA" name="section" id="districts" onclick="sectionUser()">
                                      <option value="null">Section Code</option>
                                      <option value="Mundakayam [5302]" <?=$row['section'] == 'Mundakayam [5302]' ? ' selected="selected"' : '';?>>Mundakayam [5302]</option>
                                      <option value="Kuttikanam [5303]" <?=$row['section'] == 'Kuttikanam [5303]' ? ' selected="selected"' : '';?>>Kuttikanam [5303]</option>
                                    </select>
                                    <span style="color: red;font-size: 14px" id="f6s"></span>
              			    					</div>
              			    				</div>
              			    			</div>


                              <div class="form-group">
                                <input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" value="<?php echo $row['pincode']; ?>" id="pincode" onkeyup="distPin()">
                  <span style="color: red;font-size: 14px" id="f7"></span>

                              </div>
  			    			<input type="submit" value="Update Engineer" class="btn btn-info btn-block" onclick="return checkNewconn()" >

              			    		</form>
<?php } ?>


                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php include 'adminfooter.php'; ?>
