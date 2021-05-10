<?php 
    include 'connection.php';
    include 'lmheader.php'; 
    $filekey = $_GET['t'];
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

           

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Feedback Query</h6>
            </div>
            <div class="card-body" >
                <form role="form" action="postcompfeedback.php?t=<?php echo $filekey; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <textarea rows="10" name="feedback" class="form-control input-sm" placeholder="Enter your feedback here." required></textarea>
                   
                </div>
            <input type="submit" value="Post Feedback" class="btn btn-info btn-block">

            </form>
            </div>
        </div>
    </div>
<!-- /.container-fluid -->
<?php include 'lmfooter.php'; ?>
