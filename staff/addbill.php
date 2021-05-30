<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
include 'staffheader.php';
include 'connection.php';
$sql = "select * from tb_connectionreg where filekey='".$_GET['t']."'";//echo $sql;exit;
$result = mysqli_query($conn,$sql);
while ($row=mysqli_fetch_array($result))
{
  $conno = $row['conno'];
  $phno = $row['phno'];
  $engid = $row['loginid'];
}

 ?>

    <script src="../validation/addbill.js"></script>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add Consumer Bill</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">BIll Details</h6>
                        </div>
                        <div class="card-body" >


                          <form role="form" action="billreg.php" method="post" enctype="multipart/form-data" name="myform">
              			    			<div class="row">
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			               				<input type="text" name="duedate" class="form-control input-sm" placeholder="Due Date" onfocus="(this.type='date')" id="sdate" onfocusout="startDate()">
                  <span style="color: red;font-size: 14px" id="s1"></span>

              			    					</div>
              			    				</div>
              			    				<div class="col-xs-6 col-sm-6 col-md-6">
              			    					<div class="form-group">
              			    						<input type="text" name="dcdate" class="form-control input-sm" placeholder="Disconnection Date" onfocus="(this.type='date')" id="edate" onfocusout="endDate()">
                  <span style="color: red;font-size: 14px" id="e1"></span>
              			    					</div>
              			    				</div>
              			    			</div>

                              <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                          <input type="text" name="initread" class="form-control input-sm" placeholder="Last Reading" id='tot' onkeyup="totTravel()">
                  <span style="color: red;font-size: 14px" id="top2"></span>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <input type="text" name="finalread" class="form-control input-sm" placeholder="Final Reading" id='tot1' onkeyup="totTravel1()">
                  <span style="color: red;font-size: 14px" id="top21"></span>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <span>Fixed Charge</span>
                                          <input type="text" name="fixcharge" class="form-control input-sm" placeholder="Fixed Charge" value="120" id='tot2' onkeyup="totTravel2()">
                  <span style="color: red;font-size: 14px" id="top22"></span>
                                  </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                  <div class="form-group">
                                    <span>Energy Charge</span>
                                    <input type="text" name="energycharge" class="form-control input-sm" placeholder="Energy Charge" value="8" id='tot3' onkeyup="totTravel3()">
                  <span style="color: red;font-size: 14px" id="top23"></span>
                                  </div>
                                </div>
                              </div>

              			    			<div class="form-group">
              			    				<input type="hidden" name="conno"  class="form-control input-sm" value="<?php echo $conno; ?>">
              			    			</div>
              			    			<div class="form-group">
              			    				<input type="hidden" name="phno"  class="form-control input-sm" value="<?php echo $phno; ?>">
                                <input type="hidden" name="engid"  class="form-control input-sm" value="<?php echo $engid; ?>">
              			    			</div>

              			    		
  			    			<input type="submit" value="Add Bill" class="btn btn-info btn-block" onclick="return checkAlls()">

              			    		</form>




                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->
<?php include 'stafffooter.php';  }
  else
  {
  Header("location:../index.php");
  }
?>