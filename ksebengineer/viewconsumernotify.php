<?php
  include 'connection.php';
  include 'engheader.php';

  $sql="select * from tb_connotify inner join tb_connectionreg on tb_connotify.conno=tb_connectionreg.conno where tb_connotify.loginid='".$_COOKIE['lkey']."'";//echo $sql;exit;
 // $sql = "select * from tb_connotify where loginid='".$_COOKIE['lkey']."'";
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Consumer Mail Notifications</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Notification Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Consumer #</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Date</th>
                                            <th>Consumer #</th>
                                            <th>Full Name</th>
                                            <th>Address</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['connotdate']; ?></td>
                                            <td><?php echo $row['conno']; ?></td>
                                            <td><?php echo $row['fname']." ".$row['lname']; ?></td>
                                            <td><?php echo $row['address']; ?></td>
                                            <td><?php echo $row['connotdesc']; ?></td>
                                            <td><font color="violet" size="3px"><b>Mail Sent</b></font></td>

                                        </tr>
                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            <?php include 'engfooter.php'; ?>
