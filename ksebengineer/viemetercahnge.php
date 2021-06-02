<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';
  $lkey = $_COOKIE['lkey'];

  $sql = "select * from tb_engineerreg where loginid='".$lkey."' ";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {  
    $section=$row['section'];
  }

  $sql = "select * from tb_meterchangerequest where msection='".$section."' and delstatus!='0' order by mid desc";
  //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Meter Change Requests</h1>
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
                                            <th>Section</th>
                                            <th>Purpose</th>
                                            <th>Phone #</th>
                                            <th>Approve / Reject</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Date</th>
					                        <th>Name</th>
                                            <th>Section</th>
                                            <th>Purpose</th>
                                            <th>Phone #</th>
                                            <th>Approve / Reject</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['mdate']; ?></td>
                                            <td><?php echo $row['mname']; ?></td>
                                            <td><?php echo $row['msection']; ?></td>
                                            <td><?php echo $row['mpurpose']; ?></td>
                                            <td><?php echo $row['mphno']; ?></td>
                                            <td>                                         
                            <?php  
                                $status = $row['mstatus'];
                                if($status==0)
                                { ?>
                                    <a href="approvemeter.php?t=<?php echo $row['mkey']; ?>"><button class="btn btn-success">Approve</button></a>
                                    <a href="rejectmeter.php?t=<?php echo $row['mkey']; ?>"><button class="btn btn-danger">Reject</button></a>
                            <?php
                            }
                            if($status==1)
                                { ?>
                                    <font color="green" size="4px"><b>Approved</b></font>
                                  <!--   <a href="addregfeedback.php?t=<?php //echo $row['mkey']; ?>"><button class="btn btn-danger">Reject</button></a> -->

                              <?php  }
                            if($status==2)
                              { ?>
                                <font color="red" size="4px"><b>Rejected</b></font>
                                    <!-- <a href="approveaddrequest.php?t=<?php //echo $row['mkey']; ?>"><button class="btn btn-success">Approve</button></a> -->
                              <?php }
                      }
?>
</td></tr>
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