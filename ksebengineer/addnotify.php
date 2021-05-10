<?php 
    include 'connection.php';
    include 'engheader.php'; 
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Post Notifications - Public</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="addnotify1.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your feedback here." required></textarea>
                   
                </div>
            <input type="submit" value="Post Notifications" class="btn btn-info btn-block">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'engfooter.php'; ?>
