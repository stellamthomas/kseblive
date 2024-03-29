<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';
  
  $sql = "select * from tb_linemanreg inner join tb_login on tb_login.id=tb_linemanreg.loginid where engid='".$_COOKIE['lkey']."'";
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">KSEB Lineman Details</h1>
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
                                            <th>Pincode</th>
                                            <th>District</th>
                                            <th>Section</th>
                                            <th>Phone #</th>
                                            <th>Duty</th>
                                            <th>Update / Delete</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
					  <th>Date</th>
                                          <th>Name</th>
                                          <th>Address</th>
                                          <th>Email</th>
                                          <th>Pincode</th>
                                          <th>District</th>
                                          <th>Section</th>
                                          <th>Phone #</th>
                                          <th>Duty</th>
                                          <th>Update  / Delete</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					    <td><?php echo $row['curdate']; ?></td>
                                            <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['username']; ?></td>
                                            <td><?php echo $row['pincode']; ?></td>
                                            <td><?php echo $row['district']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td><?php echo $row['phno']; ?></td>
                                            <td><a href="assigndutylm.php?t=<?php echo $row['lmkey']; ?>"><button class="btn btn-success">Assign Duty</button></a></td>
                                            <td><?php $status = $row['delstatus'];
                                            if($status==0)
                                            { ?>
                                               <a href="editlm.php?t=<?php echo $row['lmkey']; ?>"><button class="btn btn-primary">Edit</button></a>&nbsp;&nbsp;
                                                 <a href="deletelm.php?t=<?php echo $row['lmkey']; ?>"><button class="btn btn-danger">Delete</button></a>
                                 <?php      }
                                            else
                                            {   ?>
                                               <font color="red"><b>Not Available</b></font>&nbsp;&nbsp;<a href="activatelm.php?t=<?php echo $row['lmkey']; ?>"><button class="btn btn-success">Activate</button></a>
                                 <?php      }    ?>


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