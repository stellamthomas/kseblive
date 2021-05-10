<?php 
    include 'connection.php';
    include 'engheader.php';
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Public And Consumer Notification</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postpublicnotify.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                                                    <select class="form-control bfh-states" data-country="US" data-state="CA" name="typestatus">
                                                        <option value="null">Notification Type</option>
                                                        <option value="0">Public</option>
                                                        <option value="1">Consumer</option>
                                                        <option value="2">Staffs</option>
                                                    </select>

                                                </div>
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your public notification here..." required></textarea>
                   
                </div>
            <input type="submit" value="Post Notification" class="btn btn-info btn-block">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'engfooter.php'; ?>
