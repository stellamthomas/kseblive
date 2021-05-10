<?php
  session_start();
	include 'connection.php';

  	$wkkey = $_GET['t'];

	$status =3;

  $sql2 = "update tb_work set wkstatus='".$status."' where wkkey='".$wkkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Staff Work Details Deleted');window.location.replace(\"viewassignduty.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Deletion Failed.');window.location.replace(\"viewassignduty.php\");</SCRIPT>";
  }

?>
