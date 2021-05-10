<?php
  session_start();
	include 'connection.php';

  	$wkkey = $_GET['t'];

	$status =2;

  $sql2 = "update tb_work set wkstatus='".$status."' where wkkey='".$wkkey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Marked As Completed');window.location.replace(\"viewworks.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Updation Failed.');window.location.replace(\"viewworks.php\");</SCRIPT>";
  }

?>
