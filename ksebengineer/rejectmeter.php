<?php
  session_start();
	include 'connection.php';

  $mkey = $_GET['t'];
	$status =2;
  $sql2 = "update tb_meterchangerequest set mstatus='".$status."' where mkey='".$mkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Rejected');window.location.replace(\"viemetercahnge.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Rejection Failed');window.location.replace(\"viemetercahnge.php\");</SCRIPT>";
  }

?>
