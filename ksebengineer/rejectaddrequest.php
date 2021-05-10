<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=2;
	

  $sql2 = "update tb_addsupplyrequest set supstatus='".$status."',supfeedback='".$_POST['feedback']."' where supkey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Request Rejected');window.location.replace(\"viewaddsupply.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Request Rejection Failed.');window.location.replace(\"viewaddsupply.php\");</SCRIPT>";
  }

?>
