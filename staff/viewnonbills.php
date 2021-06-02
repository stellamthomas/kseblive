<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'staffheader.php';
  $sql2="select engid from tb_staffreg where loginid='".$_COOKIE['lkey']."'";//echo $sql2;exit;
  $result = mysqli_query($conn,$sql2);

  while($row=mysqli_fetch_array($result))
  {
      $engid=$row["engid"];
  } //echo $engid;exit;

  $sql = "select tb_bill.*,tb_connectionreg.fname as fn,tb_connectionreg.lname as ln,tb_connectionreg.address as addr,tb_connectionreg.conno as conn from tb_bill inner join tb_connectionreg on tb_bill.consumerno=tb_connectionreg.conno where tb_bill.engid='".$engid."' and tb_bill.nonstatus='1' order by tb_bill.id desc"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">KSEB Connection Details - Non-Contact Bills</h1>
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
                                            <th>#</th>
                                            <th>Con #</th>
					                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Final Reading</th>
                                            <th>Image</th>
                                            <th>Links</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Con #</th>
					                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Final Reading</th>
                                            <th>Image</th>
                                            <th>Links</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php $c=1; 
                      while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $c++; ?></td>
                                            <td><?php echo $row['conn']; ?></td>
                                            <td><?php echo $row['fn']." ".$row['ln']; ?></td>
                                            <td><?php echo $row['addr']; ?></td>
                                            <td><?php

$s=$row['approvestatus'];                                              
if($s==0)
{ ?>
    <font color="violet"><b>-- NA --</b></font>
    <?php
}
else
{ ?>
     <?php echo $row['finalread']; ?>
<?php
}?>
                                            </td>



                                            <td><?php

$s=$row['approvestatus'];                                              
if($s==0)
{ ?>
    <font color="violet"><b>-- NA --</b></font>
    <?php
}
else
{ ?>
     <a href="../Uploads/<?php echo $row['billkey']."/".$row['meterfile']; ?>" download><i class="fa fa-download" aria-hidden="true">&nbsp;File</i></a>
<?php
}?>
                                            </td>
                                            <td>
 <?php 
 $s=$row['approvestatus'];                                              
if($s==0)
{ ?>
    <font color="violet"><b>Not Uploaded</b></font>
    <?php
}
else if($s==1)
{ ?>
    <a href="approvebill.php?t=<?php echo $row['billkey']; ?>"><button class="btn btn-success">Approve</button></a>
    <a href="rejectbill.php?t=<?php echo $row['billkey']; ?>"><button class="btn btn-danger">Reject</button></a>
<?php
}else if($s==2)
{
?>
    <font color="green"><b>Approved</b></font>
<!--     <a href="rejectbill.php?t=<?php// echo $row['billkey']; ?>"><button class="btn btn-danger">Reject</button></a> -->
<?php
}
else
{
   ?>
    <font color="red"><b>Rejected</b></font>
<!--     <a href="approvebill.php?t=<?php echo $row['billkey']; ?>"><button class="btn btn-success">Approve</button></a> -->
<?php 
}







?>
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

            <?php include 'stafffooter.php';  }
  else
  {
    Header("location:../index.php");
  }
?>