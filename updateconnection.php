<?php
include 'connection.php';
    include 'mainheader.php';
    $appid=$_GET['t']; 
$sql="select * from tb_connectionreg where filekey='".$appid."'";

  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  { 
 ?>
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">New Connection - Update Details</h2>
          <div class="col-md-8 col-lg-7">

          	<form role="form" name="myform" action="pubconnupdate.php?t=<?php echo $appid; ?>" method="post" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="fname" class="form-control input-sm" placeholder="First Name" value="<?php echo $row['fname']; ?>">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="lname" class="form-control input-sm" placeholder="Last Name" value="<?php echo $row['lname']; ?>">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email"  class="form-control input-sm" placeholder="Email Address" value="<?php echo $row['email']; ?>">
			    			</div>
			    			<div class="form-group">
			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Address"><?php echo $row['address']; ?></textarea>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<input type="text" name="phno" class="form-control input-sm" placeholder="Phone Number" value="<?php echo $row['phno']; ?>">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<div class="form-check"><label class="form-check-input" for="exampleRadios1" style="color: white;font-weight: bold;">Gender</label><br> <?php $gen=$row['gender']; ?>
  <input class="form-check-input" type="radio" name="gender" value="Male" <?php if($gen=='Male') { echo "checked"; } ?> >
  <label class="form-check-label" for="exampleRadios1" style="color: white;">
    Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  </label>

  <input class="form-check-input" type="radio" name="gender" value="Female" <?php if($gen=='Female') { echo "checked"; } ?> >
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
			               					<option value="Idukki" <?=$row['district'] == 'Idukki' ? ' selected="selected"' : '';?> >Idukki</option>
			               					<option value="Kottayam" <?=$row['district'] == 'Kottayam' ? ' selected="selected"' : '';?>>Kottayam</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
                      <select class="form-control bfh-states" data-country="US" data-state="CA" name="section">
                        <option value="null">Section Code</option>
                        <option value="Mundakayam [5302]" <?=$row['section'] == 'Mundakayam [5302]' ? ' selected="selected"' : '';?>>Mundakayam [5302]</option>
                        <option value="Kuttikanam [5303]" <?=$row['section'] == 'Kuttikanam [5303]' ? ' selected="selected"' : '';?>>Kuttikanam [5303]</option>
                      </select>
			    					</div>
			    				</div>
			    			</div>
                <div class="form-group">
                  <input type="text" name="pincode" class="form-control input-sm" placeholder="Pincode" value="<?php echo $row['pincode']; ?>">
                </div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="supplytype">
			               					<option value="null">Supply Type</option>
			               					<option value="1 Phase" <?=$row['supplytype'] == '1 Phase' ? ' selected="selected"' : '';?>>1 Phase</option>
			               					<option value="3 Phase" <?=$row['supplytype'] == '3 Phase' ? ' selected="selected"' : '';?>>3 phase</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="totalloads" class="form-control input-sm" placeholder="Total Loads (Watts)" value="<?php echo $row['totalloads']; ?>">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			               				<select class="form-control bfh-states" data-country="US" data-state="CA" name="category">
			               					<option value="null">Category</option>
			               					<option value="Agriculture">Agriculture</option>
                              <option value="Commercial" <?=$row['category'] == 'Commercial' ? ' selected="selected"' : '';?>>Commercial</option>
                              <option value="Construction" <?=$row['category'] == 'Construction' ? ' selected="selected"' : '';?>>Construction</option>
                              <option value="Domestic" <?=$row['category'] == 'Domestic' ? ' selected="selected"' : '';?>>Domestic</option>
                              <option value="Industrial" <?=$row['category'] == 'Industrial' ? ' selected="selected"' : '';?>>Industrial</option>
                              <option value="Non Commercial" <?=$row['category'] == 'Non Commercial' ? ' selected="selected"' : '';?>>Non Commercial</option>
			               			   <option value="Temporary" <?=$row['category'] == 'Temporary' ? ' selected="selected"' : '';?>>Temporary</option>
			               				</select>

			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="aadhar" class="form-control input-sm" placeholder="Aadhar Number" value="<?php echo $row['aadhar']; ?>">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<label class="form-check-label" for="exampleRadios1" style="color: white;">
    Upload any address proof [.pdf/.jpg/.doc] :
  </label>
			    				<input type="file" name="aadharfile" class="form-control input-sm" value="<?php echo $row['aadharfile']; ?>" >
			    			</div>


			    			<input type="submit" value="Update" class="btn btn-info btn-block" onclick="return checkNewconn()" >
<?php } ?>
			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'mainfooter.php';
?>
