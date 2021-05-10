<?php
  session_start();
	include 'connection.php';

  $filekey = $_GET['t'];

  $sql = "select * from tb_addsupplyrequest where supkey='".$filekey."'";
  $result = mysqli_query($conn,$sql);
  while ($row=mysqli_fetch_array($result))
  {  
    $s=$row['suppurpose'];
    $tdays=$row['tdays'];
  }

  if($s=='House Construction')
  {
    $total=100*$tdays;
  }
  if($s=='Agriculture Works')
  {
    $total=145*$tdays;
  }
  if($s=='Gates and Doors Work')
  {
    $total=70*$tdays;
  }
  if($s=='Roof Works')
  {
    $total=90*$tdays;
  }


  $status=1;
	

  $sql2 = "update tb_addsupplyrequest set supstatus='".$status."',supfeedback='Approved',total='".$total."' where supkey='".$filekey."'";
  $ex2=mysqli_query($conn,$sql2);

  if($ex2)
	{
    echo "<SCRIPT type='text/javascript'>alert('Request Approved');window.location.replace(\"viewaddsupply.php\"); </SCRIPT>";
	}
	else
	{
    echo "<SCRIPT type='text/javascript'>alert('Request Approval Failed.');window.location.replace(\"viewaddsupply.php\");</SCRIPT>";
  }

?>
