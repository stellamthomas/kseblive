<?php
  include 'connection.php';
  include 'lmheader.php';

  $sql = "select * from tb_linemanreg inner join tb_work on tb_work.staffid=tb_linemanreg.loginid where wkstatus!='3' and tb_work.staffid='".$_COOKIE['lkey']."' order by wkid desc";//echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">KSEB Staff Work</h1>
                    <p class="mb-4"></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Work Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Mark As</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
					                                <th>Date</th>
                                          <th>Title</th>
                                          <th>Description</th>
                                          <th>Status</th>
                                          <th>Mark As</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					    <td><?php echo $row['curdate']; ?></td>
                                            <td><?php echo $row['wktitle']; ?></td>
                                            <td><?php echo $row['wkdesc']; ?></td>
                                            <td><?php $status = $row['wkstatus'];
                                            if($status==0)
                                            { ?>
                                              
                                                 <font color="red"><b>Pending</b></font>
                                 <?php      }
                                            
                                            if($status==1)
                                            { ?>
                                              
                                                 <font color="violet"><b>In Progress</b></font>
                                 <?php      }
                                            
                                            if($status==2)
                                            { ?>
                                              
                                                 <font color="green"><b>Completed</b></font>
                                 <?php      }
                                            ?>


</td>
                                            <td><?php $status = $row['wkstatus'];
                                            if($status==0)
                                            { ?>
                                              
                                                 <a href="inprogress.php?t=<?php echo $row['wkkey']; ?>"><button class="btn btn-info">In Progress</button></a>
                                 <?php      }
                                 if($status==1)
                                 {
                                  ?> <a href="completed.php?t=<?php echo $row['wkkey']; ?>"><button class="btn btn-success">Completed</button></a> <?php
                                 }
                                 if($status==2)
                                {
                                  ?> <font color="grey"><b>NA</b></font> <?php
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

            <?php include 'lmfooter.php'; ?>
