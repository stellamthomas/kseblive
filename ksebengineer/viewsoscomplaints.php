<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';

  $sql = "select * from tb_complaints inner join tb_engineerreg on tb_complaints.section=tb_engineerreg.section where cutype='2' order by tb_complaints.id desc"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User Complaints</h1>
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
                                            <th>Section</th>
                                            <th>Type</th>
                                            <th>Description</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Date</th>
                                            <th>Section</th>
                                            <th>Type</th>
                                            <th>Description</th>

                                    </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
                                            <td><?php echo $row['curdate']; ?></td>
                                            <td><?php echo $row['section']; ?></td>
                                            <td><?php echo $row['comtype']; ?></td>
                                            <td><?php echo $row['comdesc']; ?></td>
                                        </tr>
                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <?php include 'engfooter.php';  }
  else
  {
  Header("location:../index.php");
  }
?>