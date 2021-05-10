<?php
  include 'connection.php';
  session_start();
  if(isset($_COOKIE['logined']) && $_COOKIE['logined']==1)
  {
  include 'custheader.php'; 
  include 'connection.php';

  $lkey = $_COOKIE['lkey'];

?>

      <section class="section section-top section-full">

      <!-- Cover -->
      <div class="bg-cover" style="background-image: url(assets/img/aa.jpg);"></div>

      <!-- Overlay -->
      <div class="bg-overlay"></div>

      <!-- Triangles -->
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-left"></div>
      <div class="bg-triangle bg-triangle-light bg-triangle-bottom bg-triangle-right"></div>

      <!-- Content -->
      <div class="container">
        <div class="row justify-content-center align-items-center"><h2 style="text-align: center;color: white;">Update Password</h2>
          <div class="col-md-8 col-lg-7">
          		
          	<form role="form" method="POST" action="passwordupdate.php" name="myform">
			    			<div class="form-group">
			    				<input type="Password" name="curpass"  class="form-control input-sm" placeholder="Current Password">
			    			</div>

			    			<div class="form-group">
			    				<input type="Password" name="pass"  class="form-control input-sm" placeholder="New Password">
			    			</div>

			    			<div class="form-group">
			    				<input type="Password" name="conpass"  class="form-control input-sm" placeholder="Confirm Password">
			    			</div>
			    			
			    			
			    			<input type="submit" value="Update" class="btn btn-info btn-block" onclick="return checkPass()">
			    		
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