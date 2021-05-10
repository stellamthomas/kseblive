<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=0;
	
  $sql2 = "update tb_notify set isview='".$status."' where notkey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Notification Marked as Hidden');window.location.replace(\"viewpublicnotify.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Notification Marked As Hidden Failed	 .');window.location.replace(\"viewpublicnotify.php\");</SCRIPT>";
  }

?>
