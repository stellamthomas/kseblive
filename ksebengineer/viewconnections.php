<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';

  $sql = "select * from tb_connectionreg where conno!='NULL' and loginid='".$_COOKIE['lkey']."'"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">KSEB New Connection Applications</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Personal Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
					                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Pincode</th>
                                            <th>District</th>
                                            <th>Section</th>
                                            <th>Supply Type</th>
                                            <th>Total Loads</th>
                                            <th>Category</th>
                                            <th>Phone #</th>
                                            <th>Con #</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
					                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Pincode</th>
                                            <th>District</th>
                                            <th>Section</th>
                                            <th>Supply Type</th>
                                            <th>Total Loads</th>
                                            <th>Category</th>
                                            <th>Phone #</th>
                                            <th>Con #</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['curdate']; ?></td>
                                            <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
                                            <td><?php echo $row['pincode']; ?></td>
                                            <td><?php echo $row['district']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td><?php echo $row['supplytype']; ?></td>
                                            <td><?php echo $row['totalloads']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['phno']; ?></td>
                                            <td>
<?php if($row['conno']=='') {?> Not Generated <?php }else { 




                                                echo $row['conno']; }?></td>
                                           
                                        </tr>
                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <?php include 'engfooter.php'; }
  else
  {
  Header("location:../index.php");
  }
?>