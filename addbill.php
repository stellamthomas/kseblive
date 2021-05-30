<?php
    include 'custheader.php'; 
    $billkey = $_GET['t'];
    $sql="select * from tb_bill where billkey='".$billkey."'";
	  $result = mysqli_query($conn,$sql);
	  while ($row=mysqli_fetch_array($result))
	  {
	    $final=$row['initialread'];
	    $fixcharge=$row['fixedcharge'];
	    $energycharge=$row['energycharge'];
	  }




?>
    <script src="validation/checkupload.js"></script>
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
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Non-Contact Bill Upload - Consumer</h2>
          <div class="col-md-8 col-lg-7">

          	<form role="form" name="myform" action="publicconnectionreg.php?t=<?php echo $billkey; ?>" method="post" enctype="multipart/form-data">
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label class="form-check-label" for="exampleRadios1" style="color: white;">
								    Last Reading
								  </label>
			               				<input type="text" name="final" class="form-control input-sm" placeholder="Last Reading" readonly value="<?php echo $final; ?>">
									<span style="color: red;font-size: 14px" id="f1"></span>
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label class="form-check-label" for="exampleRadios1" style="color: white;">
								    Current Reading
								  </label>
			    						<input type="text" name="current" class="form-control input-sm" placeholder="Current Reading" id="lname" onkeyup="lastName()">
									<span style="color: red;font-size: 14px" id="f2"></span>
			    					</div>
			    				</div>
			    			</div>

								<input type="hidden" name="fixcharge" value="<?php echo $fixcharge; ?>">

								<input type="hidden" name="energycharge" value="<?php echo $energycharge; ?>">
			    			
			    			<div class="form-group">
			    				<label class="form-check-label" for="exampleRadios1" style="color: white;">
								    Upload The Meter Board Picture With kWh Reading  [.jpg/.jpeg] :
								  </label>
			    				<input type="file" name="aadharfile" class="form-control input-sm" id="file" onchange="fileCheck()">
							<span style="color: red;font-size: 14px" id="f8"></span>
			    			</div>


			    			<input type="submit" value="Upload" class="btn btn-info btn-block" onclick="return checkNewconnz()" >

			    		</form>


          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->

    </section>

    <!-- SECTIONS -->
<?php
    include 'custfooter.php';
?>
