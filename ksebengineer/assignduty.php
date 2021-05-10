<?php include 'engheader.php'; ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Staff Duty Allocation</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Work Details</h6>
                        </div>
                        <div class="card-body" >


                          <form role="form" action="workreg.php" method="post" enctype="multipart/form-data" name="myform">
              			    			

              			    			<div class="form-group">
              			    				<input type="text" name="title"  class="form-control input-sm" placeholder=" Work Title">
                                <input type="hidden" name="staffkey" value="<?php echo $_GET['t']; ?>">
              			    			</div>
              			    			<div class="form-group">
              			    				<textarea rows="2" name="address" class="form-control input-sm" placeholder="Work Details"></textarea>
              			    			</div>

              			    			
                             
<input type="submit" value="Add Duty" class="btn btn-info btn-block">

                            

              			    		</form>




                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php include 'engfooter.php'; ?>
