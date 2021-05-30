<?php
  session_start();
	include 'connection.php';

  $billkey = $_GET['t'];


   $sql2 = "update tb_noncontactbill set constatus='3' where conbillkey='".$billkey."'";
  $ex2=mysqli_query($conn,$sql2);

  $sql2 = "update tb_bill set approvestatus='2' where billkey='".$billkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Bill Approved');window.location.replace(\"viewnonbills.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Failed.');window.location.replace(\"viewnonbills.php\");</SCRIPT>";
  }

?>
