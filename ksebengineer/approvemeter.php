<?php
  session_start();
	include 'connection.php';

  $mkey = $_GET['t'];
	$status =1;
  $sql2 = "update tb_meterchangerequest set mstatus='".$status."' where mkey='".$mkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Meter Change Request Approved');window.location.replace(\"viemetercahnge.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Approval Failed');window.location.replace(\"viemetercahnge.php\");</SCRIPT>";
  }

?>
