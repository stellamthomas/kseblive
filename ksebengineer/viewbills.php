<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';
  $sql = "select tb_bill.*,tb_connectionreg.fname as fn,tb_connectionreg.lname as ln,tb_connectionreg.address as addr,tb_connectionreg.conno as conn from tb_bill inner join tb_connectionreg on tb_bill.consumerno=tb_connectionreg.conno where tb_bill.engid='".$_COOKIE['lkey']."' and tb_bill.total!='0' order by tb_bill.id desc"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">KSEB Bill Details</h1>
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
                                            <th>Bill Date</th>
                                            <th>Due Date</th>
                                            <th>DC Date</th>
                                            <th>Initial Reading</th>
                                            <th>Last Reading</th>
                                            <th>Units Used</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Con #</th>
					                        <th>Name</th>
                                            <th>Address</th>
                                            <th>Bill Date</th>
                                            <th>Due Date</th>
                                            <th>DC Date</th>
                                            <th>Initial Reading</th>
                                            <th>Final Reading</th>
                                            <th>Units Used</th>
                                            <th>Amount</th>
                                            <th>Status</th>
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
                                            <td><?php echo $row['billdate']; ?></td>
                                            <td><?php echo $row['duedate']; ?></td>
                                            <td><?php echo $row['dcdate']; ?></td>
                                            <td><?php echo $row['initialread']; ?></td>
                                            <td><?php echo $row['finalread']; ?></td>
                                            <td><?php echo $row['unitsused']; ?></td>
                                            <td><?php echo $row['total']; ?></td>
                                            <td>
 <?php 
 $s=$row['status'];                                              
if($s==0)
{
    echo "<font color='red'><b>Not Paid</b></font>";
}
else
{
    echo "<font color='green'><b>Bill Paid</b></font>";
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

            <?php include 'engfooter.php'; }
  else
  {
  Header("location:../index.php");
  }
?>