<?php
  session_start();
  include 'connection.php';

  $mkey = $_GET['t'];
  $status = 0;

  $sql1="update tb_meterchangerequest set delstatus='".$status."' where mkey='".$mkey."'";
  $ex1=mysqli_query($conn,$sql1);

  if($ex1)
  {
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Deleted Successfully');
     window.location.replace(\"viewmeterchangestatus.php\");
     </SCRIPT>";
  }
  else
  {
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Deletion Failed');
     window.location.replace(\"viewmeterchangestatus.php\");
     </SCRIPT>";
  }

?>
