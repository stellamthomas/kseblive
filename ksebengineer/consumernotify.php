<?php 
    include 'connection.php';
    include 'engheader.php';
    $sql = "select * from tb_connectionreg where conno!='NULL' and loginid='".$_COOKIE['lkey']."'"; //echo $sql;exit;
  $result = mysqli_query($conn,$sql);
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Consumer Specific Notification - Email</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postconsumernotify.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                                                    <select class="form-control bfh-states" data-country="US" data-state="CA" name="conno">
                                                        <option value="null">Select Consumer Number</option>
                                 <?php while ($row=mysqli_fetch_array($result))
                      {  ?>
                                                        <option value="<?php echo $row['conno']; ?>"><?php echo $row['conno']." - ".$row['fname']." ".$row['lname']." - ".$row['address']; ?></option>
                    <?php } ?>
                                                    </select>

                                                </div>
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your public notification here..." required></textarea>
                   
                </div>
            <input type="submit" value="Send Notification Mail" class="btn btn-info btn-block">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'engfooter.php'; ?>
