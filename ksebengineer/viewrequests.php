<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';

  $sql = "select * from tb_connectionreg where loginid='".$_COOKIE['lkey']."'" ;//echo $sql;exit;
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

                                            <th>Punchayat</th>
                                            <th>Village</th>
                                            <th>Ward #</th>
                                            <th>House #</th>
                                            <th>Taluk</th>
                                            <th>Ration Card</th>

                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Pincode</th>
                                            <th>District</th>
                                            <th>Section</th>
                                            <th>Supply Type</th>
                                            <th>Total Loads</th>
                                            <th>Category</th>
                                            <th>Aadhar</th>
                                            <th>Document</th>
                                            <th>Phone #</th>
                                            <th>Status</th>
                                            <th>Feedback</th>
                                            <th>Con #</th>
                                            <th>Approve / Reject</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
					                        <th>Name</th>
                                            <th>Address</th>

                                            <th>Punchayat</th>
                                            <th>Village</th>
                                            <th>Ward #</th>
                                            <th>House #</th>
                                            <th>Taluk</th>
                                            <th>Ration Card</th>

                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Pincode</th>
                                            <th>District</th>
                                            <th>Section</th>
                                            <th>Supply Type</th>
                                            <th>Total Loads</th>
                                            <th>Category</th>
                                            <th>Aadhar</th>
                                            <th>Document</th>
                                            <th>Phone #</th>
                                            <th>Status</th>
                                            <th>Feedback</th>
                                            <th>Con #</th>
                                            <th>Approve / Reject</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['curdate']; ?></td>
                                            <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                            <td><?php echo $row['address']; ?></td>

                                            <td><?php echo $row['pnch']; ?></td>
                                            <td><?php echo $row['vlg']; ?></td>
                                            <td><?php echo $row['ward']; ?></td>
                                            <td><?php echo $row['hno']; ?></td>
                                            <td><?php echo $row['tlk']; ?></td>
                                            <td><?php echo $row['rtncard']; ?></td>

                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['gender']; ?></td>
                                            <td><?php echo $row['pincode']; ?></td>
                                            <td><?php echo $row['district']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td><?php echo $row['supplytype']; ?></td>
                                            <td><?php echo $row['totalloads']; ?></td>
                                            <td><?php echo $row['category']; ?></td>
                                            <td><?php echo $row['aadhar']; ?></td>
                                            <?php $path="../Uploads/".$row['filekey']."/".$row['aadharfile']; ?>

                                            <td><a href="<?php echo $path; ?>" download>AddressProof</a></td>
                                            <td><?php echo $row['phno']; ?></td>
                                            <td>
                                            <?php   
                                            
                                            $status = $row['status'];
                                            if($status==0)
                                            { ?>
                                               <a href="markviewed.php?t=<?php echo $row['filekey']; ?>"><button class="btn btn-primary">Mark Viewed</button></a>
                                                <?php 
                                            }
                                            if ($status==1 || $status==2 || $status==4 || $status==5)
                                            {  ?>
                                                <a href="feedback.php?t=<?php echo $row['filekey']; ?>"><button class="btn btn-info">Send Feedback</button></a>
                                             <?php                                           
                                            }  ?></td><td><?php echo $row['feedback']; ?></td>
                                            <td>
<?php if($row['conno']=='') {?> Not Generated <?php }else { 




                                                echo $row['conno']; }?></td>
                                            <td>
                                            
                                            <?php $status = $row['status'];
                                            if($status==2 || $status == 1) //rejectapplication.php
                                            { ?>
                                               <a href="approveapplication.php?t=<?php echo $row['filekey']; ?>"><button class="btn btn-primary">Approve</button></a>
                                               <a href="feedbackreject.php?t=<?php echo $row['filekey']; ?>"><button class="btn btn-danger">Reject</button></a>
                                            <?php
                                            }
                                            if($status==4)
                                            { ?>
                                                    <font color="green" size="3px"><b>Approved</b></font>

                                 <?php           } if($status==5) {
                                            ?>
<font color="red" size="3px"><b>Rejected</b></font><a href="approveapplication.php?t=<?php echo $row['filekey']; ?>"><button class="btn btn-primary">Approve</button></a>
<?php } ?>
                                          </td>
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