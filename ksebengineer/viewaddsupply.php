<?php
  include 'connection.php';
  include 'engheader.php';
  $lkey = $_COOKIE['lkey'];

  $sql = "select * from tb_engineerreg where loginid='".$lkey."' ";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {  
    $section=$row['section'];
  }

  $sql = "select * from tb_addsupplyrequest where supsection='".$section."' order by supid desc";
  $result = mysqli_query($conn,$sql);
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Additional Supply Requests</h1>
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
                                            <th>Amount</th>
                                            <th>Feedback</th>
                                            <th>Payment</th>
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
                                            <th>Amount</th>
                                            <th>Feedback</th>
                                            <th>Payment</th>
                                            <th>Approve / Reject</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                      <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                        <tr>
					                        <td><?php echo $row['supdate']; ?></td>
                                            <td><?php echo $row['supname']; ?></td>
                                            <td><?php echo $row['supsection']; ?></td>
                                            <td><?php echo $row['suppurpose']; ?></td>
                                            <td><?php echo $row['supphno']; ?></td>
                                            <td><?php echo $row['total']." INR"; ?></td>
                                            <td>
<?php if($row['supfeedback']=='Approved'){ ?>  <font color="green"><b><?php echo $row['supfeedback']; ?></b></font> <?php } else { ?>  <font color="red"><b><?php echo $row['supfeedback']; ?></b></font> <?php } ?>

                                                </td>
                                            




                                            <td>
<?php  
    $status = $row['suppaymentstatus'];
    if($status==0)
    { ?>
        <img src="npaid.png" height="60" width="50"></img>
<?php
    }
    else
    {
?>
        <img src="paid.png" height="60" width="50"></img>
<?php
    }

?>

                                            </td>

<?php  
    $status = $row['suppaymentstatus']; if($status==0) { ?>                                          <td>
<?php  
    $status = $row['supstatus'];
    if($status==0)
    { ?>
        <a href="approveaddrequest.php?t=<?php echo $row['supkey']; ?>"><button class="btn btn-success">Approve</button></a>
        <a href="addregfeedback.php?t=<?php echo $row['supkey']; ?>"><button class="btn btn-danger">Reject</button></a>
<?php
}
if($status==1)
    { ?>
        <font color="green" size="4px"><b>Approved</b></font>
        <a href="addregfeedback.php?t=<?php echo $row['supkey']; ?>"><button class="btn btn-danger">Reject</button></a>

  <?php  }
if($status==2)
  { ?>
    <font color="red" size="4px"><b>Rejected</b></font>
        <a href="approveaddrequest.php?t=<?php echo $row['supkey']; ?>"><button class="btn btn-success">Approve</button></a>
  <?php }




?>
</td> <?php }else { ?>
    <td> <font color="grey" size="5px"><b>N O - L I N K S</b></font></td> <?php } ?>
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
