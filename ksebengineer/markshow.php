<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];
  $status=1;
	
  $sql2 = "update tb_notify set isview='".$status."' where notkey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Notification Marked as Visible');window.location.replace(\"viewpublicnotify.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Notification Marked As Visible Failed	 .');window.location.replace(\"viewpublicnotify.php\");</SCRIPT>";
  }

?>
