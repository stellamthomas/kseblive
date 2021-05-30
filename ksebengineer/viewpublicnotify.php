<?php
session_start();
if(isset($_SESSION['logined']) && $_SESSION['logined']==1)
{ 
  include 'connection.php';
  include 'engheader.php';

  $sql = "select * from tb_notify where loginid='".$_COOKIE['lkey']."'";
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Public Notifications</h1>
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
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['notdate']; ?></td>
                                            <td><?php echo $row['notdesc']; ?></td>
<td>

<?php
        $status=$row['notstatus'];
        if($status==0)
        { ?>
            <font color="violet" size="3px"><b>Public</b></font> 
<?php
        }else if($status==1){ ?>

            <font color="#ff3399" size="3px"><b>Consumers</b></font> 

<?php   }else { ?>

        <font color="#996633" size="3px"><b>Staffs</b></font> 
<? }?>
<?php }
    

?>

</td>

<td>

<?php
        $status=$row['isview'];
        if($status==1)
        { ?>
            <font color="green" size="3px"><b>Showing</b></font> <a href="markhide.php?t=<?php echo $row['notkey']; ?>"><button class="btn btn-danger">Hide</button></a>
<?php
        }else{ ?>

            <font color="red" size="3px"><b>Not Showing</b></font> <a href="markshow.php?t=<?php echo $row['notkey']; ?>"><button class="btn btn-primary">Show</button></a>

<?php   }
    

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

            <?php include 'engfooter.php';  }
  else
  {
  Header("location:../index.php");
  }
?>